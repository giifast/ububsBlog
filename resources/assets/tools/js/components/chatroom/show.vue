<template>
  <div class="chat-container">
    <div class="c-rooms">
      <div class="c-content">
        <div id="c-show" class="c-show">
          <List :loading="loading">
            <ListItem v-for="item in lists" :key="item.id">
              <ListItemMeta :class="item.isme == true ? 'c-self': ''" avatar="/resources/images/logo.jpeg" :title="item.ip" :description="item.content" />
            </ListItem>
          </List>
        </div>
        <div class="c-input">
          <p class="c-text"><Input v-model="content" type="textarea" :autosize="{minRows: 3}" placeholder="Enter something..."></Input></p>
          <p class="c-submit">
            <Button type="primary" :loading="send_loading" @click="send">
              <span v-if="!send_loading">发送</span>
              <span v-else>Loading...</span>
            </Button></p>
        </div>
      </div>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/chatroom/show.scss";
</style>
<script src="../../components-js/chatroom/show.js"></script>