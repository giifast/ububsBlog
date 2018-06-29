<template>
    <div class="article-container">
        <ul class="article-list">
            <li class="article-detail" v-for="list in data" :key="list.id">
                <router-link :to="{name: 'articleDetail', params: {id : list.id}}" class="article-title">{{list.title}}</router-link>
                <span class="article-create-time">{{list.created_at | parseTime('{d} {M} {y}')}}</span>
            </li>
        </ul>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/article/index.scss";
</style> 
<script src="../../components-js/article/index.js"></script>