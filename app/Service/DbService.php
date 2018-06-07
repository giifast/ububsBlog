<?php
namespace App\Service;

use Ububs\Core\Component\Db\Db;

class DbService extends BaseService
{

    public function dumpDatabase($name)
    {
        $tables = [];
        if (!$name) {
            $tablesQuery = Db::query("show tables");
            if (empty($tablesQuery)) {
                return true;
            }
            $dir = APP_ROOT . 'public/databases/' . date('Ymd');
            if (!is_dir($dir)) {
                dir_make($dir);
            }
            $path   = $dir . DS . date('YmdHis') . rand() . rand() . '.sql';
            foreach ($tablesQuery as $key => $item) {
                $tables[] = array_values($item)[0];
            }
        } else {
            $tables[] = $name;
        }
        foreach ($tables as $table) {
            $sql  = "show create table " . $table;
            $row  = Db::query($sql);
            $info = "-- ----------------------------\r\n";
            $info .= "-- Table structure for `" . $table . "`\r\n";
            $info .= "-- ----------------------------\r\n";
            $info .= "DROP TABLE IF EXISTS `" . $table . "`;\r\n";
            $sqlStr = $info . end($row[0]) . ";\r\n\r\n";
            //追加到文件
            file_put_contents($path, $sqlStr, FILE_APPEND);

            // 数据读取
            $info = "-- ----------------------------\r\n";
            $info .= "-- Records for `" . $table . "`\r\n";
            $info .= "-- ----------------------------\r\n";
            file_put_contents($path, $info, FILE_APPEND);

            //读取数据
            $seSql = "SELECT * FROM {$table}";
            $row   = Db::query($seSql);
            if (empty($row)) {
                break;
            }
            foreach ($row as $fie => $zd) {
                $sqlStr = "INSERT INTO `" . $table . "` VALUES (";
                $sqlStr .= "'" . implode("','", $zd) . "', ";
                //去掉最后一个逗号和空格
                $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 2);
                $sqlStr .= ");\r\n";
                file_put_contents($path, $sqlStr, FILE_APPEND);
            }
        }
        return str_replace(APP_ROOT, '', $path);
    }

}
