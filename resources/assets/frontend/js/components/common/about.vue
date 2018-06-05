<template>
    <div class="about-container">
        <MavonEditor v-model="data.content" :toolbarsFlag="false" :subfield="false" :defaultOpen="preview"></MavonEditor>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/about.scss";
</style>
<script src="../../components-js/common/about.js"></script>