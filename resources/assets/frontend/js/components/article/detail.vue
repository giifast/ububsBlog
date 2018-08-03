<template>
    <div class="article-detail-container">
        <h1 class="article-title">{{list.title}}</h1>
        <div class="article-content">
        	<MavonEditor v-model="list.content" :toolbarsFlag="false" :subfield="false" :defaultOpen="preview"></MavonEditor>
        	<div class="article-footer">
        		<p>上一篇：<router-link :to="{path: '/article/detail/' + this.prev.id}" v-if="prev.id">{{prev.title}}</router-link><a href="javascript:;" v-else>没有了</a></p>
        		<p>下一篇：<router-link :to="{path: '/article/detail/' + this.next.id}" v-if="next.id">{{next.title}}</router-link><a href="javascript:;" v-else>没有了</a></p>
        	</div>
            <div class="comment-lists">
                <h2 class="ub-h2">最近评论</h2>
                <ul class="comment-ul">
                    <template v-for="lists in data">
                        <li class="comment-li" v-for="list in lists" :key="list.id">
                            <a href="javascript:;" class="ub-user">{{list.address | defaultValue('未知地区')}} 网友(<span>{{list.created_at | parseTime('{d} {M} {y}')}}</span>)：</a>
                            <span class="ub-content">{{list.content}}</span>
                        </li>
                    </template>
                </ul>
                <p class="load-more" v-if="hasMore"><a href="javascript:;" @click="loadMore">更多...</a></p>
                <p class="load-more" v-if="!hasMore"><a href="javascript:;">没有更多了...</a></p>
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/article/detail.scss";
</style>
<script src="../../components-js/article/detail.js"></script>