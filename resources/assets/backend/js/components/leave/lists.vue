<template>
    <div>
        <Row class="table-header">
            <Col span="18">
                <div class="search-box">
                    <Input v-model="search.ip_address.value" placeholder="请输入搜索ip" style="width: 150px"></Input>
                    <Input v-model="search.mail.value" placeholder="请输入搜索邮箱地址" style="width: 150px"></Input>
                    <Select v-model="search.status.value" placeholder="请选择留言状态" style="width:150px">
                        <Option v-for="item in options.status" :value="item.value" :key="item.value">
                            {{ item.text }}
                        </Option>
                    </Select>
                    <Button type="primary" icon="ios-search" @click="lists()">搜索</Button>
                    <Button type="ghost" @click="reset()">重置</Button>
                </div>
            </Col>
            <Col span="6">
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
        <!-- 弹出层 -->
        <Modal v-model="modal.show" :title="modal.title" :mask-closable="false" :loading="loading" @on-ok="save('form')" @on-cancel="cancel('form')">
            <Form ref="form" :model="fromData" :rules="rules" :label-width="80">
                <FormItem label="回复对象">
                    123
                </FormItem>
                <FormItem label="内容" prop="content">
                    <textarea v-model="fromData.mail" placeholder="请输入回复内容"></textarea>
                </FormItem>
            </Form>
        </Modal>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/leave/lists.scss";
</style>
<script src="../../components-js/leave/lists.js"></script>