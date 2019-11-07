<template>
  <div class="login-container">
    <Form
      ref="loginForm"
      :model="loginForm"
      :label-width="60"
      :rules="ruleValidate"
      class="login-form"
    >
      <FormItem
        label="帐号"
        prop="account"
      >
        <Input
          v-model="loginForm.account"
          placeholder="Enter your account"
        ></Input>
      </FormItem>
      <FormItem
        label="密码"
        prop="account"
      >
        <Input
          type="password"
          v-model="loginForm.password"
          placeholder="Enter your password"
        ></Input>
      </FormItem>
      <FormItem label="记住密码">
        <i-switch v-model="loginForm.remeber">
          <span slot="open">是</span>
          <span slot="close">否</span>
        </i-switch>
      </FormItem>
      <FormItem>
        <Button
          type="primary"
          :loading="this.$store.state.loading"
          @click="login('loginForm')"
        >登录</Button>
        <Button
          type="success"
          :loading="loading"
          @click="visitLogin()"
        >游客登陆</Button>
        <Button
          type="ghost"
          @click="reset('loginForm')"
          style="margin-left: 8px"
        >重置</Button>
      </FormItem>
    </Form>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
    @import "../../../sass/common/login.scss";
</style>
<script src="../../components-js/common/login.js"></script>