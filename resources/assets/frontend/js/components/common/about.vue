<template>
  <div class="about-container">
    <div>
      <MavonEditor v-model="data.about" :toolbarsFlag="false" :defaultOpen="preview" :subfield="false"
        :code_style="code_style" :ishljs="true" :externalLink="externalLink"></MavonEditor>
    </div>
    <div>
      <p>{{data.copyright}}</p>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/about.scss";
</style>
<script src="../../components-js/common/about.js"></script>