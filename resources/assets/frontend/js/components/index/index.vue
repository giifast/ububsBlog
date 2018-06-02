<template>
    <div class="article-container">
        <template v-for="(item, year) in lists">
            <h2 class="article-year">{{year}}</h2>
            <ul class="article-list">
            	<li class="article-detail" v-for="list in item" :key="list.id">
            		<a href="javascript:;" class="article-title"><span class="ub-blue">[原创] </span>{{list.title}}</a>
            		<span class="article-create-time">{{list.create_time}}</span>
            	</li>
            </ul>
        </template>
        <div>
        	<p class="load-more"><a href="javascript:;">更多...</a></p>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/index/index.scss";
</style>
<script src="../../components-js/index/index.js"></script>