<template>
    <div class="article-container">
        <!-- <template v-for="(item, year) in data">
            <h2 class="article-year">{{year}}</h2>
            <ul class="article-list">
            	<li class="article-detail" v-for="list in item" :key="list.id">
            		<a href="javascript:;" class="article-title" @click="$router.push('/article/' + list.id)">{{list.title}}</a>
            		<span class="article-create-time">{{list.create_time}}</span>
            	</li>
            </ul>
        </template> -->
        <ul class="article-list">
            <template v-for="lists in data">
                <li class="article-detail" v-for="list in lists" :key="list.id">
                    <a href="javascript:;" class="article-title" @click="$router.push('/article/detail/' + list.id)">{{list.title}}</a>
                    <span class="article-create-time">{{list.created_at}}</span>
                </li>
            </template>
        </ul>
        <p class="load-more" v-if="hasMore"><a href="javascript:;" @click="loadMore">更多...</a></p>
        <p class="load-more" v-if="!hasMore"><a href="javascript:;">没有更多了...</a></p>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/index/index.scss";
</style>
<script src="../../components-js/index/index.js"></script>