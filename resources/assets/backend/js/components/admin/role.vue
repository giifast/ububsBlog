<template>
	<div class="admin-role-container">
        <Row class="table-header">
            <Col span="18">
                <div class="search-box">
                    <Input v-model="search.name.value" placeholder="请输入搜索名称" style="width: 150px"></Input>
                    <Select v-model="search.status.value" placeholder="请选择角色状态" style="width:150px">
                        <Option v-for="item in options.status" :value="item.value" :key="item.value">
                            {{ item.text }}
                        </Option>
                    </Select>
                    <Button type="primary" icon="ios-search" @click="lists()">搜索</Button>
                    <Button type="ghost" @click="reset()">重置</Button>
                </div>
            </Col>
            <Col span="6">
                <div class="fastmenu-box">
                    <Button type="info" @click="$router.push('/admin/role/add')">新建</Button>
                </div>
            </Col>
        </Row>
        <Table border ref="selection" :columns="columns" :data="data" @on-selection-change="selectChange"></Table>
        <div class="table-footer">
            <div class="batch-box">
                <Button size="small" @click="batchDelete()">批量删除</Button>
            </div>
            <div class="pagination-box">
                <Page size="small" :total="pagination.total" :current="pagination.currentPage" :page-size="pagination.pageSize" @on-change="currentPageChange" @on-page-size-change="pageSizeChange" :page-size-opts="pagination.sizeOptions" show-total show-sizer></Page>
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
    @import "../../../sass/admin/role.scss";
</style>
<script src="../../components-js/admin/role.js"></script>