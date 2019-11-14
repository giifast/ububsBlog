<template>
  <div class="chat-container">
    <div class="c-content">
      <div id="c-show" class="c-show">
        <Scroll :on-reach-top="handleReachTop" height="550">
          <List :loading="loading">
            <ListItem v-for="(item, index) in lists" :key="index">
              <ListItemMeta :class="item.isme == true ? 'c-self': ''" :avatar="'/resources/images/' + generateAvatar(item.ip) + '.png'" :title="item.ip" :description="item.content" />
              <template slot="action">
                <li>
                  <a href="javascript:;">点赞</a>
                </li>
                <li>
                  <a href="javascript:;">回复</a>
                </li>
                <li>
                  <a class="created_at" href="javascript:;">{{item.created_at | parseTime()}}</a>
                </li>
              </template>
            </ListItem>
          </List>
        </Scroll>
      </div>
      <div class="c-input">
        <p class="c-text"><Input v-model="content" type="textarea" :autosize="{minRows: 3}" placeholder="撩一下看看..."></Input></p>
        <p class="c-submit">
          <Button type="primary" :loading="send_loading" @click="send">
            <span v-if="!send_loading">发送</span>
            <span v-else>Loading...</span>
          </Button></p>
      </div>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/chatroom/show.scss";
</style>
<script src="../../components-js/chatroom/show.js"></script>