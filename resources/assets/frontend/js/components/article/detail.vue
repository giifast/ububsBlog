<template>
    <div class="article-detail-container">
        <h1 class="article-title">{{list.title}}</h1>
        <div class="article-content">
        	<MavonEditor v-model="list.content" :toolbarsFlag="false" :subfield="false" :defaultOpen="preview"></MavonEditor>
        	<div class="article-footer">
        		<p>上一篇：<router-link :to="{path: '/article/detail/' + this.prev.id}" v-if="prev.id">{{prev.title}}</router-link><a href="javascript:;" v-else>没有了</a></p>
        		<p>下一篇：<router-link :to="{path: '/article/detail/' + this.next.id}" v-if="next.id">{{next.title}}</router-link><a href="javascript:;" v-else>没有了</a></p>
        	</div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/article/detail.scss";
</style>
<script src="../../components-js/article/detail.js"></script>