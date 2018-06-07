<template>
    <div>
        <Row class="table-header">
            <Col span="18">
                <div class="search-box">
                    <Input v-model="search.title.value" placeholder="请输入搜索标题" style="width: 150px"></Input>
                    <Input v-model="search.author.value" placeholder="请输入搜索作者" style="width: 150px"></Input>
                    <Select v-model="search.category_menu_id.value" style="width: 150px;">
                        <Option v-for="item in options.categoryMenus" :value="item.id" :key="item.id">{{ item.name }}</Option>
                    </Select>
<!--                     <Select v-model="search.status.value" placeholder="请选择文章状态" style="width:150px">
                        <Option v-for="item in options.article_status" :value="item.value" :key="item.value">
                            {{ item.text }}
                        </Option>
                    </Select> -->
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
@import "../../../sass/article/lists.scss";
</style>
<script src="../../components-js/article/lists.js"></script>