<template>
    <div class="article-container">
        <ul class="article-list">
            <li class="article-detail" v-for="list in data" :key="list.id">
                <a href="javascript:;" class="article-title" @click="$router.push('/article/detail/' + list.id)">{{list.title}}</a>
                <span class="article-create-time">{{list.create_time}}</span>
            </li>
        </ul>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/article/index.scss";
</style> 
<script src="../../components-js/article/index.js"></script>