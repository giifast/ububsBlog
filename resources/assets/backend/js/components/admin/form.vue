<template>
    <div class="admin-form-container">
        <div class="body-card">
            <div class="card-title">
                <Tag type="dot" color="blue">基本信息</Tag>
            </div>
            <div class="card-content">
                <Row>
                    <Col :sm="24" :md="12">
                    <Form ref="form" :model="formData" :rules="rules" :label-width="80">
                        <FormItem label="用户名" prop="account">
                            <Input v-model="formData.account" placeholder="请输入用户名"></Input>
                        </FormItem>
                        <FormItem label="邮箱" prop="mail">
                            <Input v-model="formData.mail" placeholder="请输入邮箱地址"></Input>
                        </FormItem>
                        <FormItem label="所属角色" prop="role_id" width="150">
                            <Select v-model="formData.role_id">
                                <Option v-for="item in options.roles" :value="item.id" :key="item.id">{{ item.name }}</Option>
                            </Select>
                        </FormItem>
                        <FormItem label="密码" prop="password">
                            <Input type="password" v-model="formData.password" :placeholder="pwText"></Input>
                        </FormItem>
                        <FormItem label="确认密码" prop="repassword">
                            <Input type="password" v-model="formData.repassword" placeholder="请再次输入密码"></Input>
                        </FormItem>
                        <FormItem label="状态" prop="status">
                            <Select v-model="formData.status" placeholder="请选择状态">
                                <Option v-for="item in options.status" :value="item.value" :key="item.value">
                                    {{ item.text }}
                                </Option>
                            </Select>
                        </FormItem>
                        <FormItem>
                            <Button type="primary" @click="submitBase('form')">提交</Button>
                        </FormItem>
                    </Form>
                    </Col>
                    <Col :sm="24" :md="12">
                    </Col>
                </Row>
            </div>
        </div>
        <div class="body-card">
            <div class="card-title">
                <Tag type="dot" color="green">管理员权限</Tag>
            </div>
            <div class="card-content">
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/admin/form.scss";
</style>
<script src="../../components-js/admin/form.js"></script>