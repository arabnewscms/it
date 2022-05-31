<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonSchema extends Controller {

	public static function convention_name($string) {
		$conv = strtolower(ltrim(preg_replace('/(?<!\ )[A-Z]/', '_$0', $string), '_'));
		if (!in_array(substr($conv, -1), ['s'])) {
			if (substr($conv, -1) == 'y') {
				$conv = substr($conv, 0, -1) . 'ies';
			} else {
				$conv = $conv . 's';
			}
		}
		return $conv;
	}

	public static function autoconvSchemaTableName($conv) {
		if (!in_array(substr($conv, -1), ['s'])) {
			if (substr($conv, -1) == 'y') {
				$conv = substr($conv, 0, -1) . 'ies';
			} else {
				$conv = $conv . 's';
			}
		}
		return $conv;
	}

	public static function migrate($r) {
		$migrate = '<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By ' . it_version_message() . '
// Copyright Reserved  ' . it_version_message() . '
class Create{ClassName}Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\'{TBLNAME}\', function (Blueprint $table) {
            $table->bigIncrements(\'id\');
';

		$migrate .= self::get_cols($r);
		if (request()->has('enable_soft_delete')) {
			$migrate .= '			$table->softDeletes();' . "\n\r";
		}
		$migrate .= '			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\'{TBLNAME}\');
    }
}';

		$migrate = str_replace('{ClassName}', self::autoconvSchemaTableName($r->input('model_name')), $migrate);
		$migrate = str_replace('{TBLNAME}', self::convention_name($r->input('model_name')), $migrate);
		return $migrate;
	}

	public static function get_cols($r) {
		$cols = '';
		$i = 0;

		if ($r->has('has_user_id')) {
			$cols .= '$table->foreignId("admin_id")->constrained("admins")->onUpdate("cascade")->onDelete("cascade");' . "\n";
			//$cols .= '            $table->bigInteger(\'admin_id\')->unsigned()->nullable();' . "\n";
			//$cols .= '            $table->foreign(\'admin_id\')->references(\'id\')->on(\'admins\')->onDelete(\'cascade\');' . "\n";
			/*
				$table->bigInteger('user_id')->unsigned()->nullable();
				$table->foreign('user_id')->references('id')->on('users')->o‌​nDelete('cascade');
			*/
		}

		/*if ($r->has('schema_name')) {
			$i           = 0;
			$schema_null = $r->input('schema_null');
			foreach ($r->input('schema_name') as $schema_name) {
			if (!empty($schema_null[$i])) {
			$cols .= '            $table->bigInteger(\''.$schema_name.'\')->nullabel();'."\n";

			} else {
			$cols .= '            $table->bigInteger(\''.$schema_name.'\');'."\n";
			}
			$i++;
			}
		*/
		$i2 = 0;

		foreach ($r->input('col_name_convention') as $conv) {
			if ($r->has('forginkeyto' . $i2)) {
				$cols .= self::forgin_key($conv, $i2, $r);
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$cols .= self::enum($conv, $i2, $r);
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {
					$cols .= self::check_radio($conv, $i2, $r);
				}
			} else {
				$cols .= self::str_num($conv, $i2, $r);
			}
			$i2++;
		}

		return $cols;
	}

	public static function forgin_key($name, $i, $r) {
		if (preg_match('/|/', $name)) {
			$name = explode('|', $name)[0];
		}
		$cols = '';

		$references = $r->input('references' . $i);
		$tblname = $r->input('forgin_table_name' . $i);

		$signature = '            $table->foreignId("' . $name . '"){nullable}->constrained("' . $tblname . '")->references("' . $references . '"){onUpdate}{onDelete};' . "\n";

		if ($r->has('schema_nullable' . $i)) {
			$signature = str_replace('{nullable}', '->nullable()', $signature);
		} else {
			$signature = str_replace('{nullable}', '', $signature);
		}

		if ($r->has('schema_onDelete' . $i) && $r->has('schema_onUpdate' . $i)) {
			$signature = str_replace('{onDelete}', '->onDelete("cascade")', $signature);
			$signature = str_replace('{onUpdate}', '->onUpdate("cascade")', $signature);
		} elseif ($r->has('schema_onDelete' . $i)) {
			$signature = str_replace('{onUpdate}', '', $signature);
			$signature = str_replace('{onDelete}', '->onDelete("cascade")', $signature);
		} elseif ($r->has('schema_onUpdate' . $i)) {
			$signature = str_replace('{onUpdate}', '->onUpdate("cascade")', $signature);
			$signature = str_replace('{onDelete}', '', $signature);
		} else {
			$signature = str_replace('{onUpdate}', '', $signature);
			$signature = str_replace('{onDelete}', '', $signature);
		}
		$cols .= $signature;
		return $cols;
	}

	public static function check_radio($name, $i, $r) {
		$col = '';
		$name = explode('#', $name);
		if ($r->input('col_name_null' . $i) == 'has') {
			if ($r->has('numeric' . $i) and $r->has('numeric' . $i) == 1) {
				$col .= '            $table->bigInteger(\'' . $name[0] . '\'';
			} elseif (!$r->has('numeric' . $i)) {
				if ($r->input('col_type')[$i] == 'textarea') {
					$col .= '            $table->longtext(\'' . $name[0] . '\'';
				} elseif ($r->input('col_type')[$i] == 'textarea_ckeditor') {
					$col .= '            $table->longtext(\'' . $name[0] . '\'';
				} else {
					$col .= '            $table->string(\'' . $name[0] . '\'';
				}
			}

			if ($r->has('required' . $i)) {
				$col .= ');' . "\n";
			} else {
				$col .= ')->nullable();' . "\n";
			}
		} else {

			$col .= '            $table->string(\'' . $name[0] . '\'';
			$col .= ')->nullable();' . "\n";
		}

		return $col;
	}

	public static function str_num($name, $i, $r) {
		$col = '';
		if ($r->input('col_name_null' . $i) == 'has') {
			if ($r->has('numeric' . $i) and $r->has('numeric' . $i) == 1) {
				$col .= '            $table->bigInteger(\'' . $name . '\'';
			} elseif (!$r->has('numeric' . $i)) {
				if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'textarea') {
					$col .= '            $table->longtext(\'' . $name . '\'';
				} elseif (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'textarea_ckeditor') {
					$col .= '            $table->longtext(\'' . $name . '\'';
				} elseif ($r->input('col_type')[$i] == 'date_time') {
					$col .= '            $table->dateTime(\'' . $name . '\'';
				} elseif ($r->input('col_type')[$i] == 'date') {
					$col .= '            $table->date(\'' . $name . '\'';
				} elseif ($r->input('col_type')[$i] == 'time') {
					$col .= '            $table->time(\'' . $name . '\'';
				} elseif ($r->input('col_type')[$i] == 'timestamp') {
					$col .= '            $table->timestamp(\'' . $name . '\'';
				} elseif ($r->has('date' . $i)) {
					$col .= '            $table->date(\'' . $name . '\'';
				} elseif ($r->input('col_type')[$i] != 'dropzone') {
					$col .= '            $table->string(\'' . $name . '\'';
				}
			}
			if ($r->input('col_type')[$i] != 'dropzone') {
				if ($r->has('required' . $i)) {
					$col .= ');' . "\n";
				} else {
					$col .= ')->nullable();' . "\n";
				}
			}
		} else {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'textarea') {
				$col .= '            $table->longtext(\'' . $name . '\'';
			} elseif (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'textarea_ckeditor') {
				$col .= '            $table->longtext(\'' . $name . '\'';
			} elseif ($r->input('col_type')[$i] == 'date_time') {
				$col .= '            $table->dateTime(\'' . $name . '\'';
			} elseif ($r->input('col_type')[$i] == 'date') {
				$col .= '            $table->date(\'' . $name . '\'';
			} elseif ($r->input('col_type')[$i] == 'time') {
				$col .= '            $table->time(\'' . $name . '\'';
			} elseif ($r->input('col_type')[$i] == 'timestamp') {
				$col .= '            $table->timestamp(\'' . $name . '\'';
			} elseif ($r->has('date' . $i)) {
				$col .= '            $table->date(\'' . $name . '\'';
			} elseif ($r->input('col_type')[$i] != 'dropzone') {
				$col .= '            $table->string(\'' . $name . '\'';
			}

			if ($r->input('col_type')[$i] != 'dropzone') {
				$col .= ')->nullable();' . "\n";
			}
		}

		return $col;
	}

	public static function enum($name, $i, $r) {
		$pre_name = explode('|', $name);

		if ($r->input('forginkeyto' . $i) == 'has' || preg_match('/App/i', $pre_name[1])) {
			return self::forgin_key($pre_name[0], $i, $r);
		} else {
			$pre_name2 = explode('/', $pre_name[1]);
			$cols = '            $table->enum(\'' . $pre_name[0] . '\',[';

			$listenum = '';
			foreach ($pre_name2 as $v) {

				$v2 = explode(',', $v);
				$listenum .= '\'' . $v2[0] . '\',';

			}

			$cols .= rtrim($listenum, ',');
			if ($r->input('col_name_null' . $i) == 'has') {
				if ($r->input('required' . $i) == 1) {
					$cols .= ']);' . "\n";
				} else {
					$cols .= '])->nullable();' . "\n";
				}
			} else {
				$cols .= '])->nullable();' . "\n";
			}
			return $cols;
		}
	}

}
