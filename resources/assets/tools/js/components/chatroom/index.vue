<template>
  <div class="chat-container">
    <div>
      <AutoComplete v-model="value1" :data="data1" @on-search="handleSearch" placeholder="input here"
        style="width:200px"></AutoComplete>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/chatroom/index.scss";
</style>
<script src="../../components-js/chatroom/index.js"></script>