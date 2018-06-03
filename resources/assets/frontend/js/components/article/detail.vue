<template>
    <div class="article-detail-container">
        <h1 class="article-title">{{list.title}}</h1>
        <div class="article-content">
        	<MavonEditor v-model="list.content" :toolbarsFlag="false" :subfield="false" :defaultOpen="preview"></MavonEditor>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/article/detail.scss";
</style>
<script src="../../components-js/article/detail.js"></script>