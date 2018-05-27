<?php
namespace App\Http\Controllers;
use App\Files;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class FileUploader extends Controller {

	public static function sizes() {
		return [
			'25'   => '25',
			'50'   => '50',
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
			'1000' => '1000',
			'1024' => '1024',
			'2048' => '2048',
		];
	}

	//////// resize image ////////////////////////////////////////////
	public static function upload($request, $path, $typeid = 'icon', $id = null, $uid = null, $admin_id = null, $resize = null) {
		if ($resize === null) {
			$resize = 'no';
		} else {
			$resize = 'yes';
		}
		if (substr($path, -1) == '/') {
			$path = substr($path, 0, -1);
		}
		if (is_string($request) || is_numeric($request) || is_int($request)) {
			$file = request()->file($request);
		} else if (is_object($request) || is_array($request)) {
			$file = $request;
		}
		$ext        = $file->getClientOriginalExtension();
		$size       = self::GetSize($file->getSize());
		$size_bytes = $file->getSize();
		$mimtype    = $file->getMimeType();
		$full_path  = $file->store($path);
		$hashname   = $file->hashName();
		if ($typeid != 'icon') {

			$upload = Files::create([
					'admin_id'   => $admin_id,
					'user_id'    => $uid,
					'file'       => $hashname,
					'full_path'  => $full_path,
					'type_file'  => $typeid,
					'type_id'    => $id,
					'path'       => $path,
					'ext'        => $ext,
					'name'       => $file->getClientOriginalName(),
					'size'       => $size,
					'size_bytes' => $size_bytes,
					'mimtype'    => $mimtype,
				]);

			///////////// Resize  Any image ////////////////////
			if (preg_match('/image/i', $mimtype) and $resize == 'yes') {
				$img = new ImageManager(['driver' => 'imagick']);
				foreach (self::sizes() as $width  => $height) {
					$photo = Image::make(Storage::get($upload->full_path))
					                                         ->resize($width, $height, function ($constraint) {$constraint->aspectRatio();})
						->encode($upload->ext, 80);
					Storage::put($upload->path.'/'.$width.'_'.$hashname, $photo);
				}
			}
			///////////// Resize Any image ////////////////////
			return '100_'.$upload->file;
		} else {
			return $full_path;
		}
	}

	public static function update($fname, $id, $type) {
		Files::where('type_file', $type)->where('file', 'LIKE', '%'.$fname.'%')->update(['type_id' => $id]);
	}

	/* Delete One File Where type and id */
	public static function delete($id = null, $type = null, $specific = null) {

		$path = preg_match('/public/i', $id)?explode('public/', $id)[1]:$id;
		if ($type === null && $id !== null and !is_numeric($id)) {
			if (Storage::disk(env('FILESYSTEM_DRIVER', 'public'))->has($path)) {
				Storage::delete($id);
			}
		} elseif ($specific !== null && $specific > 0) {
			$delete = Files::find($specific);
			if (!empty($delete)) {
				foreach (self::sizes() as $key => $val) {
					if (Storage::disk(env('FILESYSTEM_DRIVER', 'public'))->has($path)) {
						Storage::delete($delete->path.$key.'_'.$delete->file);
						Storage::deleteDirectory($delete->path);
					}
				}
				Storage::delete($delete->full_path);
				Storage::deleteDirectory($delete->path);
				$delete->forceDelete();
			}
		} elseif (!empty($type) and !empty($id) && empty($specific)) {
			$delete_all = Files::where('type_file', $type)->where('type_id', $id)->get();
			foreach ($delete_all as $delete) {
				foreach (self::sizes() as $key => $val) {
					if (Storage::has($delete->path.'/'.$val.'_'.$delete->file)) {
						Storage::delete($delete->path.'/'.$val.'_'.$delete->file);
					}
				}
				Storage::delete($delete->full_path);
				Storage::deleteDirectory($delete->path);
				Storage::deleteDirectory($type.'/'.$id);
				$delete->forceDelete();
			}
		}
	}
	/* Delete One File Where type and id */

	public static function GetSize($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes/1073741824, 2).' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes/1048576, 2).' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes/1024, 2).' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes.' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes.' byte';
		} else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}

	public function image($ext = null) {
		if (!empty($ext)) {
			return 'image|mimes:'.$ext;
		} else {
			return 'image|mimes:jpeg,jpg,png,bmp,gif,psd,pdf';
		}
	}

	public function office($ext = null) {
		if (!empty($ext)) {
			return 'mimes:'.$ext;
		} else {
			return 'mimes:doc,docx,xls,dot,wbk,docm,dotx,dotm,docb,xlt,xlm,xlsm,xlsx,xltx,xltm,xlsb,xla,xlam,xll,xlw,ppt,pot,pps,pptx,pptm,potx,potm,ppam,ppsx,ppsm,sldx,sldm,pub';
		}
	}

	public function audio($ext = null) {
		if (!empty($ext)) {
			return 'mimes:'.$ext;
		} else {
			return 'mimes:mpga,wav,s3m,sil,uvva,uva,eol,dra,dts,dtshd,lvp,pya,weba,aac,aif,mka,m3u,wax,wma,ram,rmp,mp2,mp2a,mp3,m2a,m3a,oga,ogg,spx';
		}
	}

	public function video($ext = null) {
		if (!empty($ext)) {
			return 'mimes:'.$ext;
		} else {
			return 'mimes:3gp,3g2,h261,h263,h264,jpgv,mp4,mp4v,mpg4,mpeg,mpg,mpe,m1v,m2v,ogv,qt,mov,dvb,mxu,m4u,pyv,webm,m4v,vob,wm,wmv,wmx,wvx,avi,movie,smv,ice,mpeg,mpg';
		}
	}

	public function url($path) {
		return Storage::disk(env('FILESYSTEM_DRIVER', 'public'))->url($path);
	}

	public function compress_file($ext = null) {
		if (!empty($ext)) {
			return 'mimes:'.$ext;
		} else {
			return 'mimes:ZIP,SITX,7Z,RAR,GZ,7Z,ZIPX';
		}
	}

}
