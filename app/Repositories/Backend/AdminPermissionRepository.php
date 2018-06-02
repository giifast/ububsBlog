<?php 
namespace App\Http\Repositories\Backend;

class AdminPermissionRepository extends CommonRepository
{
	/**
	 * 获取列表
	 * @param  array $input 
	 * @return array        
	 */
    public function lists($input)
    {
    	$pagination = isset($input['pagination']) ? $input['pagination'] : [];
    	$search = isset($input['search']) ? $input['search'] : [];
    	list($start, $end) = $this->parsePages($pagination);
    	$whereParams = $this->parseWheres($search);
        $result['lists'] = DB::table('adminPermission')->where($whereParams)->limit($start, $end)->get();
        $result['total'] = DB::table('adminPermission')->count();
        return $result;
    }

    /**
     * 获取一条数据
     * @param  int $id id
     * @return array     
     */
    public function show($id)
    {
    	$result['list'] = DB::table('adminPermission')->where(['id' => $id])->get();
    	return $result;
    }

    /**
     * 新增
     * @param  array $input 新增内容
     * @return array 
     */
    public function insert($input)
    {
    	$insertData = [];
		if (!isset($input['username']) || $input['username'] === '') {
			return ['code' => ['adminPermission', '1002']];
		}
		// 管理员名不得重复
		if (DB::table('adminPermission')->where(['username' => $username])->isExist()) {
			return ['code' => ['adminPermission', '1005']];
		}
		$insertData['username'] = $input['username'];
    	if (!isset($input['password'])) {
    		return ['code' => ['adminPermission', '1004']];
    	}
    	$insertData['password'] = generatePassword($input['password']);
    	if (isset($input['email'])) {
    		// 邮箱地址不得重复
    		if (DB::table('adminPermission')->where(['email' => $email])->isExist()) {
    			return ['code' => ['adminPermission', '1006']];
    		}
    		$insertData['email'] = $input['email'];
    	}
    	if (isset($input['status'])) {
    		$insertData['status'] = intval($input['status']);
    	}
    	$result = DB::table('adminPermission')->insert($insertData);
    	if (!$result) {
    		return ['code' => ['common', '1002']];
    	}
    	return ['message' => ['common', '1001']];
    }

    /**
     * 编辑
     * @param  int $id    id
     * @param  array $input 更新内容
     * @return array        
     */
    public function edit($id, $input)
    {
    	$editData = [];
    	if (isset($input['name'])) {
    		if ($input['name'] === '') {
    			return ['code' => ['adminPermission', '3001']];
    		}
    		// 权限名称不得重复
    		if (DB::table('adminPermission')->where(['name' => $name])->whereNot(['id' => $id])->isExist()) {
    			return ['code' => ['adminPermission', '3002']];
    		}
    		$editData['name'] = $input['name'];
    	}
    	if (isset($input['status'])) {
    		$editData['status'] = intval($input['status']);
    	}
    	$result = DB::table('adminPermission')->where(['id' => $id])->update($editData);
    	if (!$result) {
    		return ['code' => ['common', '3002']];
    	}
    	return ['message' => ['common', '3001']];
    }

    /**
     * 删除一个或多个
     * @param  string $ids 待删除的id
     * @return array      
     */
    public function delete($ids)
    {
    	$idArr = explode(',', $ids);
    	if (!empty($idArr)) {
    		$deleteIdArr = [];
    		foreach ($idArr as $id) {
    			if ($id && !in_array($id, $deleteIdAr)) {
    				$deleteIdArr[] = $id;
    			}
    		}
    		DB::table('adminPermission')->whereIn([
	    		'id' => $deleteIdArr
	    	]);
    	}
    	return [
    		'message' => ['common', '2001']
    	];
    }
}