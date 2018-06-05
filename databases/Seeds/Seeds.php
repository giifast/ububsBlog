<?php
namespace Databases\Seeds;

use FwSwoole\DB\DB;

class Seeds
{
    public static function run()
    {
        self::userSeed();
        self::adminSeed();
        self::roleSeed();
        self::menuSeed();
        self::categoryMenuSeed();
        self::tagSeed();
        self::dictSeed();
    }

    private static function roleSeed()
    {
        DB::table('role')->truncate();
        $data = [
            [
                'name'             => '超级管理员',
                'super_permission' => 1,
                'menu_ids'         => '',
            ],
            [
                'name'             => '普通管理员1',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7',
            ],
            [
                'name'             => '普通管理员2',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'name'             => '普通管理员3',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'name'             => '普通管理员4',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
            [
                'name'             => '普通管理员5',
                'super_permission' => 0,
                'menu_ids'         => '1,2,3,4,5,6,7,8,77,22,33,44,35,567',
            ],
        ];
        DB::table('role')->insertMulti($data);
    }

    private static function tagSeed()
    {
        DB::table('tag')->truncate();
        $data = [
            [
                'name' => 'PHP后端技术',
            ],
            [
                'name' => 'Java后端技术',
            ],
            [
                'name' => '服务端技术',
            ],
            [
                'name' => 'nginx服务器',
            ],
            [
                'name' => '前端技术',
            ],
            [
                'name' => 'javascript',
            ],
            [
                'name' => 'css',
            ],
        ];
        DB::table('tag')->insertMulti($data);
    }

    private static function categoryMenuSeed()
    {
        DB::table('category_menu')->truncate();
        $category = [10, 20];
        $data     = [
            [
                'category' => $category[rand(0, 1)],
                'name'     => 'PHP后端技术',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => 'Java后端技术',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => '服务端技术',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => 'nginx服务器',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => '前端技术',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => 'javascript',
            ],
            [
                'category' => $category[rand(0, 1)],
                'name'     => 'css',
            ],
        ];
        DB::table('category_menu')->insertMulti($data);
    }

    private static function menuSeed()
    {
        DB::table('menu')->truncate();
        $insertData = [];
        $insertData[] = ['id' => 300,'pid' => 0,'name' => '网站管理','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 301,'pid' => 300,'name' => '网站设置','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 302,'pid' => 300,'name' => '网站监测','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 303,'pid' => 300,'name' => '数据备份','request_method' => '','path' => '','status' => 1];

        $insertData[] = ['id' => 400,'pid' => 0,'name' => '管理员管理','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 401,'pid' => 400,'name' => '管理员列表','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 402,'pid' => 401,'name' => '新建管理员','request_method' => '','path' => '','status' => 0];
        $insertData[] = ['id' => 403,'pid' => 401,'name' => '编辑管理员','request_method' => '','path' => '','status' => 0];
        $insertData[] = ['id' => 404,'pid' => 401,'name' => '管理员详情','request_method' => '','path' => '','status' => 0];
        $insertData[] = ['id' => 405,'pid' => 400,'name' => '角色列表','request_method' => '','path' => '','status' => 1];
        $insertData[] = ['id' => 406,'pid' => 405,'name' => '新增角色','request_method' => '','path' => '','status' => 0];
        $insertData[] = ['id' => 407,'pid' => 405,'name' => '角色详情','request_method' => '','path' => '','status' => 0];
        $insertData[] = ['id' => 408,'pid' => 405,'name' => '编辑角色','request_method' => '','path' => '','status' => 0];
        DB::table('menu')->insertMulti($insertData);
    }

    private static function userSeed()
    {
        DB::table('user')->truncate();
        $insertData = [];
        for ($i = 0; $i < 1000; $i++) {
            $insertData[] = [
                'username'        => '林联敏' . $i,
                'password'        => generatePassword('123123'),
                'mail'            => 'linlm' . $i . '@gmail.com',
                'gender'          => 10,
                'face'            => sha1($i) . '.png',
                'last_login_ip'   => '192.168.102.143',
                'last_login_time' => time(),
                'create_time'     => time(),
                'status'          => mt_rand(0, 1),
            ];
        }
        DB::table('user')->insertMulti($insertData);
    }

    private static function adminSeed()
    {
        DB::table('admin')->truncate();
        $insertData   = [];
        $insertData[] = [
            'role_id'         => 1,
            'username'        => 'admin',
            'password'        => generatePassword('123123'),
            'mail'            => 'linlm1994@gmail.com',
            'face'            => sha1(1) . '.png',
            'last_login_ip'   => '192.168.102.143',
            'last_login_time' => time(),
            'create_time'     => time(),
            'status'          => 1,
        ];
        for ($i = 0; $i < 1000; $i++) {
            $insertData[] = [
                'role_id'         => $i % 5,
                'username'        => '林联敏' . $i,
                'password'        => generatePassword('123123'),
                'mail'            => 'linlm' . $i . '@gmail.com',
                'face'            => sha1($i) . '.png',
                'last_login_ip'   => '192.168.102.143',
                'last_login_time' => time(),
                'create_time'     => time(),
                'status'          => 1,
            ];
        }
        DB::table('admin')->insertMulti($insertData);
    }

    private static function dictSeed()
    {
        DB::table('dict')->truncate();
        $data = [
            // 系统参数
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 20, 'text_en' => 'article_page_size', 'text' => '文章分页'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 20, 'text_en' => 'video_page_size', 'text' => '视频分页'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 30, 'text_en' => 'leave_page_size', 'text' => '留言分页'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 5, 'text_en' => 'article_recommend_page_size', 'text' => '文章推荐展示数'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 5, 'text_en' => 'video_recommend_page_size', 'text' => '视频推荐展示数'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 5, 'text_en' => 'leave_recommend_page_size', 'text' => '留言推荐展示数'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 0, 'text_en' => 'article_comment_audit', 'text' => '评论审核'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 0, 'text_en' => 'leave_audit', 'text' => '留言审核'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 10, 'text_en' => 'login_limit_time', 'text' => '登录限制时间，秒'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 10, 'text_en' => 'backend_login_limit_time', 'text' => '后台登录限制时间，秒'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 10, 'text_en' => 'repeat_limit_times', 'text' => '频繁操作次数'],
            ['code' => 'system', 'code_name' => '系统参数', 'value' => 10, 'text_en' => 'repeat_limit_time', 'text' => '频繁操作限制时间。秒'],
            // 性别
            ['code' => 'gender', 'code_name' => '性别', 'value' => 0, 'text_en' => 'unknown', 'text' => '未知'],
            ['code' => 'gender', 'code_name' => '性别', 'value' => 10, 'text_en' => 'male', 'text' => '男'],
            ['code' => 'gender', 'code_name' => '性别', 'value' => 20, 'text_en' => 'female', 'text' => '女'],
            // 菜单类型
            ['code' => 'category', 'code_name' => '菜单类型', 'value' => 10, 'text_en' => 'article', 'text' => '文章菜单'],
            ['code' => 'category', 'code_name' => '菜单类型', 'value' => 20, 'text_en' => 'video', 'text' => '视频菜单'],
            // 审核
            ['code' => 'audit', 'code_name' => '审核结果', 'value' => 0, 'text_en' => 'loading', 'text' => '审核中'],
            ['code' => 'audit', 'code_name' => '审核结果', 'value' => 10, 'text_en' => 'refuse', 'text' => '拒绝'],
            ['code' => 'audit', 'code_name' => '审核结果', 'value' => 20, 'text_en' => 'pass', 'text' => '通过'],
            // 文章状态
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 0, 'text_en' => 'not_show', 'text' => '下架'],
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 10, 'text_en' => 'recycle', 'text' => '回收站'],
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 20, 'text_en' => 'audit_loading', 'text' => '审核中'],
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 30, 'text_en' => 'show', 'text' => '正常'],
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 40, 'text_en' => 'draft', 'text' => '草稿'],
            ['code' => 'article_status', 'code_name' => '文章状态', 'value' => 50, 'text_en' => 'recommend', 'text' => '推荐'],
            // 视频状态
            ['code' => 'video_status', 'code_name' => '视频状态', 'value' => 0, 'text_en' => 'not_show', 'text' => '未显示'],
            ['code' => 'video_status', 'code_name' => '视频状态', 'value' => 10, 'text_en' => 'freezing', 'text' => '冻结'],
            ['code' => 'video_status', 'code_name' => '视频状态', 'value' => 20, 'text_en' => 'audit_loading', 'text' => '审核中'],
            ['code' => 'video_status', 'code_name' => '视频状态', 'value' => 30, 'text_en' => 'show', 'text' => '正常'],
        ];
        DB::table('dict')->insertMulti($data);
    }
}
