<template>
    <Form class="article-from-container" ref="form" :model="formData" :rules="rules" :label-width="80">
        <Row :gutter="20">
            <Col :sm="24" :md="18">
            <FormItem label="标题" prop="title">
                <Input v-model="formData.title" placeholder="请输入文章标题"></Input>
            </FormItem>
            <FormItem label="正文" prop="content">
                <div class="mavon-edit-box">
                    <MavonEditor v-model="formData.content" ref="maEdit" @imgAdd="$imgAdd"></MavonEditor>
                </div>
            </FormItem>
            </Col>
            <Col :sm="24" :md="6">
            <Card>
                <div slot="title">
                    <h3><Icon type="android-menu"></Icon>&nbsp;&nbsp;标签与分类</h3>
                </div>
                <div>
                    <FormItem label="文章标签" prop="tags">
                        <Select v-model="formData.tags" multiple>
                            <Option v-for="item in options.tags" :value="item.id" :key="item.id">{{ item.name }}</Option>
                        </Select>
                    </FormItem>
                    <FormItem label="文章类别" prop="category_menu_id">
                        <Select v-model="formData.category_menu_id">
                            <Option v-for="item in options.categoryMenus" :value="item.id" :key="item.id">{{ item.name }}</Option>
                        </Select>
                    </FormItem>
                </div>
            </Card>
            <Card>
                <div slot="title">
                    <h3><Icon type="ios-pricetags-outline"></Icon>&nbsp;&nbsp;缩略图</h3>
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
                    <FormItem label="作者" prop="author">
                        <Input v-model="formData.author" placeholder="请输入文章作者"></Input>
                    </FormItem>
                    <FormItem label="转载说明" prop="reprinted">
                        <Input v-model="formData.reprinted" type="textarea" placeholder="请输入转载说明"></Input>
                    </FormItem>
                </div>
            </Card>
            <Card>
                <div slot="title">
                    <h3><Icon type="share"></Icon>&nbsp;&nbsp;发布</h3>
                </div>
                <div>
                    <FormItem label="发表时间" prop="create_time">
                        <DatePicker :disabled="articleId ? true : false" v-model="formData.create_time" type="date" placeholder="默认文章创建时间"></DatePicker>
                    </FormItem>
                    <FormItem label="状态" prop="status">
                        <Select v-model="formData.status">
                            <Option v-for="item in options.article_status" :value="item.value" :key="item.value">{{ item.text }}</Option>
                        </Select>
                    </FormItem>
                    <FormItem>
                        <Button type="primary" :loading="loadingSave" @click="save('form')">{{articleId ? '保存' : '发布'}}</Button>
                        <Button type="ghost" :loading="loadingDraft" @click="draft()">保存草稿</Button>
                    </FormItem>
                </div>
            </Card>
            </Col>
        </Row>
    </Form>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/article/form.scss";
</style>
<script src="../../components-js/article/form.js"></script>