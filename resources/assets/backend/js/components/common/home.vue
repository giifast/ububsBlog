<template>
    <div class="common-home-container">
        <div class="home-container-header">
            <Row :gutter="20">
                <Col :sm="24" :md="9">
                <Card class="home-detail-box ub-face">
                    <div slot="title">
                        <Row type="flex">
                            <Col span="8">
                            <Row class-name="face-box" type="flex" align="middle">
                                <img class="avator-img" src="/resources/images/face.jpg" />
                            </Row>
                            </Col>
                            <Col span="16">
                            <Row class-name="data-box" type="flex" align="middle">
                                <div>
                                    <h2 class="user-name">{{adminData.account}}<strong class="user-role">（{{adminData.roleName}}）</strong></h2>
                                    <div class="user-detail-data">
                                        <Row>
                                            <Col span="8" style="padding: 0">
                                            <p>邮箱地址：</p>
                                            </Col>
                                            <Col span="16">
                                            <p>{{adminData.mail}}</p>
                                            </Col>
                                        </Row>
                                    </div>
                                </div>
                            </Row>
                            </Col>
                        </Row>
                    </div>
                    <Row class="margin-top-8">
                        <Col span="8">
                        <p class="notwrap">上次登录时间：</p>
                        </Col>
                        <Col span="16" class="padding-left-8">{{adminData.last_login_time | parseTime}} <a href="#" v-if="adminData.last_login_time">(查询历史)</a></Col>
                    </Row>
                    <Row class="margin-top-8">
                        <Col span="8">
                        <p class="notwrap">上次登录地点：</p>
                        </Col>
                        <Col span="16" class="padding-left-8">{{adminData.last_login_ip | defaultValue('未登录')}}</Col>
                    </Row>
                </Card>
                <Card class="home-detail-box ub-active-history">
                    <div slot="title">
                        <p>网站动态</p>
                    </div>
                    <div slot="extra">
                        <p><a href="#">查看更多</a></p>
                    </div>
                    <div class="active-content">
                        <p>1、2018/03/01 赞了 <a href="#">《去iView官网学习完整的iView组件》</a></p>
                        <p>2、2018/03/02 评论了 <a href="#">《股份香港-业务审批流程（贸易）》</a></p>
                        <p>3、2018/03/02 收藏了 <a href="#">《单行文本框-数据源(2017-11-29 10:05:20:系统管理员)》</a></p>
                        <p>4、2018/03/03 赞了 <a href="#">《发布的新闻-限时置顶》</a></p>
                        <p>5、2018/03/19 评论了 <a href="#">《姚嘉敏新建的需要审核的新闻》</a></p>
                        <p>6、2018/03/19 评论了 <a href="#">《姚嘉敏新建的需要审核的新闻》</a></p>
                    </div>
                </Card>
                <Card class="home-detail-box ub-online-history">
                    <div slot="title">
                        <p>网站流量ip统计</p>
                    </div>
                    <div class="ub-online-chart">
                        <div id="onlineChart" style="width: 90%; height: 350px;"></div>
                    </div>
                </Card>
                </Col>
                <Col :sm="24" :md="15">
                <div class="ub-website-day">
                    <Row :gutter="25">
                        <Col span="6">
                        <InforCard cardLeftBgColor="#2d8cf0" :cardHeaderText="newRegister.number" cardBodyText="今日新增用户">
                            <Icon slot="card-left-content" type="person-add"></Icon>
                        </InforCard>
                        </Col>
                        <Col span="6">
                        <InforCard cardLeftBgColor="#ff9900" :cardHeaderText="newRegister.number" cardBodyText="今日访问ip总数">
                            <Icon slot="card-left-content" type="eye"></Icon>
                        </InforCard>
                        </Col>
                        <Col span="6">
                        <InforCard cardLeftBgColor="#19be6b" :cardHeaderText="newRegister.number" cardBodyText="今日动态总数">
                            <Icon slot="card-left-content" type="lightbulb"></Icon>
                        </InforCard>
                        </Col>
                        <Col span="6">
                        <InforCard cardLeftBgColor="#ed3f14" :cardHeaderText="newRegister.number" cardBodyText="今日未处理">
                            <Icon slot="card-left-content" type="email-unread"></Icon>
                        </InforCard>
                        </Col>
                    </Row>
                </div>
                </Col>
            </Row>
        </div>
        <div class="home-container-footer">
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/common/home.scss";
</style>
<script src="../../components-js/common/home.js"></script>