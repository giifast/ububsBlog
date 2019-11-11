<template>
  <div class="chat-container">
    <div class="c-rooms">
      <AutoComplete v-model="name" icon="ios-search" :clearable="true" enter-button="Search" @on-change="search"
        :filter-method="filterSearch" placeholder="请输入房间名称，点击名称进入房间" size="large">
        <Option v-for="item in rooms" :value="item.name" :key="item.id">
          <span class="demo-auto-complete-title">{{ item.name }}</span>
          <span class="demo-auto-complete-count" v-show="item.id > 0">当前 {{ item.count | defaultValue('0')}} 人在线</span>
          <span class="demo-auto-complete-count" v-show="item.id == -1">房间不存在</span>
        </Option>
      </AutoComplete>
      <p class="c-button"><Button type="success" long @click="join">点击进入/创建</Button></p>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/chatroom/index.scss";
</style>
<script src="../../components-js/chatroom/index.js"></script>