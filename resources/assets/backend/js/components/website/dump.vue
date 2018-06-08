<template>
    <div>
        <Row class="table-header">
            <Col span="18">
                <div class="search-box">
                    <DatePicker type="daterange" placement="bottom-end" placeholder="Select date" style="width: 200px" v-model="search.created_at.value"></DatePicker>
                    <Button type="primary" icon="ios-search" @click="lists()">搜索</Button>
                </div>
            </Col>
            <Col span="6">
                <div class="fastmenu-box">
                    <Button type="info" @click="$router.push('/article/new')">新建</Button>
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
@import "../../../sass/website/dump.scss";
</style>
<script src="../../components-js/website/dump.js"></script>