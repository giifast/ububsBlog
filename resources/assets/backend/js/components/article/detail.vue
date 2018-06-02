<template>
    <Form class="article-detail-container" :label-width="80">
        <Row :gutter="20">
            <Col :sm="24" :md="16">
            <FormItem label="标题">
                <h3>{{detailData.title}}</h3>
            </FormItem>
            <FormItem label="正文">
                <MavonEditor v-model="detailData.content" :toolbarsFlag="false" :subfield="false" :defaultOpen="preview"></MavonEditor>
            </FormItem>
            <FormItem label="缩略图">
                <div>
                    <img class="ub-thumbnail" :src="detailData.thumbnail" alt="缩略图" v-if="detailData.thumbnail">
                    <p v-if="!detailData.thumbnail">无</p>
                </div>
            </FormItem>
            <FormItem label="创建人">
                <div><span>{{detailData.username}}</span></div>
            </FormItem>
            <FormItem label="文章标签">
                <div>
                    <Tag v-for="tagId in detailData.tags" :key="tagId">
                        {{tagId | filterOptions(options.tags, 'id', 'name')}}
                    </Tag>
                </div>
            </FormItem>
            <FormItem label="所属类别">
                <div><span>{{detailData.category_menu_id | filterOptions(options.categoryMenus, 'id', 'name')}}</span></div>
            </FormItem>
            <FormItem label="作者">
                <div><span>{{detailData.author}}</span></div>
            </FormItem>
            <FormItem label="转载说明">
                <div><span>{{detailData.reprinted}}</span></div>
            </FormItem>
            <FormItem label="发表时间">
                <div><span>{{detailData.create_time}}</span></div>
            </FormItem>
            <FormItem label="状态">
                <div><span :style="{color: statusColor}">{{detailData.status | filterOptions(options.article_status, 'value', 'text')}}</span></div>
            </FormItem>
            </Col>
            <Col :sm="24" :md="8">
            <Card>
                <p slot="title">
                    <Icon type="compose"></Icon>
                    最近阅读
                </p>
                <a href="#" slot="extra" @click.prevent="loadMore('comment')">查看更多</a>
                <div class="read-box">
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                    <a class="read-user" href="#" target="_blank">陆逊</a>
                </div>
            </Card>
            <Card>
                <p slot="title">
                    <Icon type="grid"></Icon>
                    最新动态
                </p>
                <a href="#" slot="extra" @click.prevent="loadMore('comment')">查看更多</a>
                <ul class="comment-box">
                    <li>
                        <span class="comment-user">陆逊</span>
                        &nbsp;&nbsp;评论&nbsp;&nbsp;
                        <a href="#" target="_blank">今天股市大跌拉！</a>
                        <span>2018/03/23 13:11:58</span>
                    </li>
                    <li>
                        <span class="comment-user">陆逊</span>
                        &nbsp;&nbsp;点赞了&nbsp;&nbsp;
                        <span>2018/03/23 13:11:58</span>
                    </li>
                    <li>
                        <span class="comment-user">陆逊</span>
                        &nbsp;&nbsp;评论&nbsp;&nbsp;
                        <a href="#" target="_blank">今天股市大跌拉！</a>
                        <span>2018/03/23 13:11:58</span>
                    </li>
                    <li>
                        <span class="comment-user">陆逊</span>
                        &nbsp;&nbsp;收藏了&nbsp;&nbsp;
                        <span>2018/03/23 13:11:58</span>
                    </li>
                </ul>
            </Card>
            </Col>
        </Row>
    </Form>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/article/detail.scss";
</style>
<script src="../../components-js/article/detail.js"></script>