<template>
    <div class="admin-lists-container">
        <Row class="table-header">
            <Col span="18">
                <div class="search-box">
                    <Input v-model="search.account.value" placeholder="请输入搜索网站名" style="width: 150px"></Input>
                    <Input v-model="search.mail.value" placeholder="请输入搜索网址" style="width: 150px"></Input>
                    <Button type="primary" icon="ios-search" @click="lists()">搜索</Button>
                    <Button type="ghost" @click="reset()">重置</Button>
                </div>
            </Col>
            <Col span="6">
                <div class="fastmenu-box">
                    <Button type="info" @click="store()">新建</Button>
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
        <!-- 弹出层 -->
        <Modal v-model="modal.show" :title="modal.title" :mask-closable="false" :loading="loading" @on-ok="save('form')" @on-cancel="cancel('form')">
            <Form ref="form" :model="fromData" :rules="rules" :label-width="80">
                <FormItem label="网站名" prop="account">
                    <Input v-model="fromData.account" placeholder="请输入用户名"></Input>
                </FormItem>
                <FormItem label="网址" prop="mail">
                    <Input v-model="fromData.mail" placeholder="请输入邮箱地址"></Input>
                </FormItem>
                <FormItem label="网址" prop="mail">
                    <Input v-model="fromData.mail" placeholder="请输入邮箱地址"></Input>
                </FormItem>
                <FormItem label="状态" prop="status">
                    <Select v-model="fromData.status" placeholder="请选择状态">
                        <Option v-for="item in options.status" :value="item.value" :key="item.value">
                            {{ item.text }}
                        </Option>
                    </Select>
                </FormItem>
                <FormItem label="性别" prop="gender">
                    <RadioGroup v-model="fromData.gender">
                        <Radio :label="item.value" v-for="item in options.gender" :key="item.value">{{ item.text }}</Radio>
                    </RadioGroup>
                </FormItem>
            </Form>
        </Modal>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/website/link.scss";
</style>
<script src="../../components-js/website/link.js"></script>