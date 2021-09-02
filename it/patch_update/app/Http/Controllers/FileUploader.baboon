<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class FileUploader extends Controller {

	public static function default() {
		return config('filesystems.default');
	}
	public static function sizes() {
		return [
			'25' => '25',
			'50' => '50',
			'100' => '100',
			'200' => '200',
			'300' => '300',
			'400' => '400',
			'500' => '500',
			'1000' => '1000',
			'1024' => '1024',
			'2048' => '2048',
		];
	}

	public function getFile($type_file, $type_id) {
		return Files::where('type_file', $type_file)->where('type_id', $type_id)->orderBy('id', 'desc')->first();
	}

	public function rename($type_file, $type_id, $new_id) {
		$files = Files::where('type_file', $type_file)->where('type_id', $type_id)->get();
		$old_path = '';
		foreach ($files as $file) {
			// New Full path
			if (Storage::disk(self::default())->has($file->path)) {
				$full_path = $type_file . '/' . $new_id . '/' . $file->file;
				Storage::disk(self::default())->move($file->full_path, $full_path);
				$old_path = $file->path;

				// Update Information
				$file->full_path = $full_path;
				$file->path = $type_file . '/' . $new_id;
				$file->type_file = $type_file;
				$file->type_id = $new_id;
				$file->save();
			} else {
				$file->delete();
			}
		}
		if (Storage::disk(self::default())->has($old_path)) {
			Storage::disk(self::default())->deleteDirectory($old_path);
		}
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
		$ext = $file->getClientOriginalExtension();
		$size = self::GetSize($file->getSize());
		$size_bytes = $file->getSize();
		$mimtype = $file->getMimeType();
		$full_path = $file->store($path);
		$hashname = $file->hashName();
		if ($typeid != 'icon') {

			$upload = Files::create([
				'admin_id' => $admin_id,
				'user_id' => $uid,
				'file' => $hashname,
				'full_path' => $full_path,
				'type_file' => $typeid,
				'type_id' => $id,
				'path' => $path,
				'ext' => $ext,
				'name' => $file->getClientOriginalName(),
				'size' => $size,
				'size_bytes' => $size_bytes,
				'mimtype' => $mimtype,
			]);

			///////////// Resize  Any image ////////////////////
			if (preg_match('/image/i', $mimtype) and $resize == 'yes') {
				$img = new ImageManager(['driver' => 'imagick']);
				foreach (self::sizes() as $width => $height) {
					$photo = Image::make(Storage::disk(self::default())->get($upload->full_path))
						->resize($width, $height, function ($constraint) {$constraint->aspectRatio();})
						->encode($upload->ext, 80);
					Storage::disk(self::default())->put($upload->path . '/' . $width . '_' . $hashname, $photo);
				}
			}
			///////////// Resize Any image ////////////////////
			return '100_' . $upload->file;
		} else {
			return $full_path;
		}
	}

	public static function update($fname, $id, $type) {
		Files::where('type_file', $type)->where('file', 'LIKE', '%' . $fname . '%')->update(['type_id' => $id]);
	}

	/* Delete One File Where type and id */
	public static function delete($id = null, $type = null, $specific = null) {
		$path = preg_match('/public/i', $id) ? explode('public/', $id)[1] : $id;
		if (is_null($type) && !is_null($id) and !is_numeric($id)) {
			if (Storage::disk(self::default())->has($path)) {
				Storage::disk(self::default())->delete($id);
			}
		} elseif (!is_null($specific) && is_numeric($specific)) {
			$delete = Files::find($specific);
			if (!empty($delete)) {
				foreach (self::sizes() as $key => $val) {
					if (Storage::disk(self::default())->has($path)) {
						Storage::disk(self::default())->delete($delete->path . $key . '_' . $delete->file);
					}
				}
				Storage::disk(self::default())->delete($delete->full_path);
				self::deleteDir($delete);
				$delete->forceDelete();
			}
		} elseif (!empty($type) and !empty($id) && empty($specific)) {
			$delete_all = Files::where('type_file', $type)->where('type_id', $id)->get();
			foreach ($delete_all as $delete) {
				foreach (self::sizes() as $key => $val) {
					if (Storage::disk(self::default())->has($delete->path . '/' . $val . '_' . $delete->file)) {
						Storage::disk(self::default())->delete($delete->path . '/' . $val . '_' . $delete->file);
					}
				}
				Storage::disk(self::default())->delete($delete->full_path);
				self::deleteDir($delete);
				$delete->forceDelete();
			}
		}
	}

	/* Delete One File Where type and id */
	public static function deleteDir($delete) {
		$FileSystem = new Filesystem();

		// get current driver to prepare full path by config
		$path = config('filesystems.disks')[self::default()]['root'] . '/' . $delete->path;

		if ($FileSystem->exists($path) && !$FileSystem->files($path)) {
			Storage::disk(self::default())->deleteDirectory($delete->path);
			Storage::disk(self::default())->deleteDirectory($delete->type_file . '/' . $delete->type_id);
		}
	}

	public static function GetSize($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}

	public function image($ext = null) {
		if (!empty($ext)) {
			return 'image|mimes:' . $ext;
		} else {
			return 'image|mimes:jpeg,jpg,png,bmp,gif';
		}
	}

	public function url($path) {
		return Storage::disk(self::default())->url($path);
	}

	public function acceptedMimeTypes($mimes) {
		$getMimeType = '';
		foreach (explode('|', $mimes) as $mime) {
			// Office MimeTypes Start //
			$getMimeType .= $mime == 'office' ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.spreadsheetml.template,application/vnd.ms-powerpoint,application/vnd.ms-powerpoint.addin.macroenabled.12,application/vnd.ms-powerpoint.presentation.macroenabled.12,application/vnd.ms-powerpoint.slide.macroenabled.12,application/vnd.ms-powerpoint.slideshow.macroenabled.12,application/vnd.ms-powerpoint.template.macroenabled.12,' : '';

			$getMimeType .= $mime == 'pdf' ? 'application/pdf,' : '';
			$getMimeType .= $mime == 'docx' ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,' : '';
			$getMimeType .= $mime == 'xls' ? 'application/vnd.ms-excel,' : '';
			$getMimeType .= $mime == 'xlsx' ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,' : '';
			$getMimeType .= $mime == 'xltx' ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.template,' : '';
			$getMimeType .= $mime == 'ppt' ? 'application/vnd.ms-powerpoint,' : '';
			$getMimeType .= $mime == 'ppam' ? 'application/vnd.ms-powerpoint.addin.macroenabled.12,' : '';
			$getMimeType .= $mime == 'pptm' ? 'application/vnd.ms-powerpoint.presentation.macroenabled.12,' : '';
			$getMimeType .= $mime == 'sldm' ? 'application/vnd.ms-powerpoint.slide.macroenabled.12,' : '';
			$getMimeType .= $mime == 'ppsm' ? 'application/vnd.ms-powerpoint.slideshow.macroenabled.12,' : '';
			$getMimeType .= $mime == 'potm' ? 'application/vnd.ms-powerpoint.template.macroenabled.12,' : '';
			// Office MimeTypes End //
			// Audio MimeTypes Start //
			$getMimeType .= $mime == 'audio' ? 'audio/xm,audio/x-wav,audio/ogg,audio/adpcm,audio/mpeg,' : '';
			$getMimeType .= $mime == 'xm' ? 'audio/xm,' : '';
			$getMimeType .= $mime == 'wav' ? 'audio/x-wav,' : '';
			$getMimeType .= $mime == 'ogg' ? 'audio/ogg,' : '';
			$getMimeType .= $mime == 'adp' ? 'audio/adpcm,' : '';
			$getMimeType .= $mime == 'mp3' ? 'audio/mpeg,' : '';
			// Audio MimeTypes End //
			// Video MimeTypes Start //
			$getMimeType .= $mime == 'video' ? 'video/mp4,video/3gpp,video/mpeg,video/quicktime,video/webm,video/x-matroska,video/x-ms-wmv,video/x-msvideo,video/video/x-ms-vob,' : '';
			$getMimeType .= $mime == 'mp4' ? 'video/mp4,' : '';
			$getMimeType .= $mime == '3gp' ? 'video/3gpp,' : '';
			$getMimeType .= $mime == 'mpeg' ? 'video/mpeg,' : '';
			$getMimeType .= $mime == 'mov' ? 'video/quicktime,' : '';
			$getMimeType .= $mime == 'webm' ? 'video/webm,' : '';
			$getMimeType .= $mime == 'mkv' ? 'video/x-matroska,' : '';
			$getMimeType .= $mime == 'wmv' ? 'video/x-ms-wmv,' : '';
			$getMimeType .= $mime == 'avi' ? 'video/x-msvideo,' : '';
			$getMimeType .= $mime == 'vob' ? 'video/video/x-ms-vob,' : '';
			// Video MimeTypes End //
			// Image MimeTypes start //
			$getMimeType .= $mime == 'image' ? 'image/*,' : '';
			// Image MimeTypes End //

		}
		return str_replace('\n\r', '', $getMimeType);
	}

}