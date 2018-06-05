<template>
    <Form class="article-from-container" ref="form" :model="formData" :rules="rules" :label-width="80">
        <Row :gutter="20">
            <Col :sm="24" :md="18">
            <FormItem label="网站名称" prop="title">
                <Input v-model="formData.title" placeholder="请输入网站名称"></Input>
            </FormItem>
            <FormItem label="网站关键字">
                <div>
                    <Tag v-for="(item, index) in formData.keywords" :key="index" :name="index" closable @on-close="deleteKeyword">{{item}}</Tag>
                </div>
                <Input v-model="keyword" placeholder="输入网站关键字，空格添加" clearable style="width: 200px" @keyup.enter.native="addKeyword"></Input>
            </FormItem>

            <FormItem label="关于" prop="content">
                <div class="mavon-edit-box">
                    <MavonEditor v-model="formData.content" ref="maEdit" @imgAdd="$imgAdd"></MavonEditor>
                </div>
            </FormItem>
            </Col>
            <Col :sm="24" :md="6">
            <Card>
                <div slot="title">
                    <h3><Icon type="ios-pricetags-outline"></Icon>&nbsp;&nbsp;我的头像</h3>
                </div>
                <a href="#" slot="extra" @click.prevent="clearThumbnail">
                    <Icon type="trash-a"></Icon>
                    清空
                </a>
                <div>
                    <Upload
                        :accept="uploadConfig.accept"
                        :max-size="uploadConfig.maxSize"
                        :type="uploadConfig.type"
                        :format="uploadConfig.format"
                        :on-progress="uploadProgress"
                        :on-success="uploadSuccess"
                        :on-format-error="uploadFormatError"
                        :on-exceeded-size="uploadExceedSize"
                        :on-remove="uploadRemove"
                        :default-file-list="uploadConfig.defaultFile"
                        :action="uploadConfig.action"
                        ref="upload">
                        <img class="ub-thumbnail" :src="formData.thumbnail">
                        <div style="padding: 20px 0" v-show="!formData.thumbnail">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>点击此处上传文章缩略图</p>
                        </div>
                    </Upload>
                </div>
            </Card>
            <Card>
                <div slot="title">
                    <h3><Icon type="information-circled"></Icon>&nbsp;&nbsp;版权信息</h3>
                </div>
                <div>
                    <Input v-model="formData.copyright" type="textarea" placeholder="请输入版权说明"></Input>
                </div>
            </Card>
            <Card>
                <div slot="title">
                    <h3><Icon type="share"></Icon>&nbsp;&nbsp;保存</h3>
                </div>
                <div>
                    <FormItem label="网站状态" prop="status">
                        <i-switch size="large" v-model="formData.status" @on-change="changeStatus">
                            <span slot="open">开启</span>
                            <span slot="close">关闭</span>
                        </i-switch>
                    </FormItem>
                    <FormItem>
                        <Button type="primary" :loading="loadingSave" @click="save('form')">保存</Button>
                    </FormItem>
                </div>
            </Card>
            </Col>
        </Row>
    </Form>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/website/setting.scss";
</style>
<script src="../../components-js/website/setting.js"></script>