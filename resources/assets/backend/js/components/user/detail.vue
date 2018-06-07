<template>
    <Row :gutter="20" class="user-detail-container">
        <Col span="8">
        <Card class="user-detail-box face">
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
                            <h2 class="user-name">{{userData.account}}<strong class="user-status">（{{userData.status | filterOptions(options.status, 'value', 'text')}}）</strong></h2>
                            <div class="user-detail-data">
                                <Row>
                                    <Col span="8" style="padding: 0">
                                        <p >邮箱地址：</p>
                                        <p >性别：</p>
                                    </Col>
                                    <Col span="16">
                                        <p>{{userData.mail}}</p>
                                        <p>{{userData.gender | filterOptions(options.gender, 'value', 'text')}}</p>
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
                <Col span="16" class="padding-left-8">{{userData.last_login_time | defaultValue('未登录')}} <a href="#" v-if="userData.last_login_time">(查询历史)</a></Col>
            </Row>
            <Row class="margin-top-8">
                <Col span="8">
                <p class="notwrap">上次登录地点：</p>
                </Col>
                <Col span="16" class="padding-left-8">{{userData.last_login_ip | defaultValue('未登录')}}</Col>
            </Row>
        </Card>
        <Card class="user-detail-box read-history">
            <div slot="title">
                <h2>最近浏览</h2>
            </div>
            <div slot="extra">
                <a href="#">
                    <!-- <Icon type="more"></Icon> -->
                    查看更多
                </a>
            </div>
            <div class="read-content">
                <p>1、去iView官网学习完整的iView组件</p>
                <p>2、股份香港-业务审批流程（贸易）(2017-11-29)</p>
                <p>3、单行文本框-数据源(2017-11-29 10:05:20:系统管理员)</p>
                <p>4、发布的新闻-限时置顶</p>
                <p>5、姚嘉敏新建的需要审核的新闻</p>
                <p>6、股份香港-业务审批流程</p>
            </div>
        </Card>
        <Card class="user-detail-box active-history">
            <div slot="title">
                <h2>最近动态</h2>
            </div>
            <div slot="extra">
                <a href="#">
                    <!-- <Icon type="more"></Icon> -->
                    查看更多
                </a>
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
        </Col>
        <Col span="16">
        <Card class="user-detail-box online-history">
            <div class="online-chart">
                <div id="main" style="width: 90%; height: 350px;"></div>
            </div>
        </Card>
        </Col>
    </Row>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/user/detail.scss";
</style>
<script src="../../components-js/user/detail.js"></script>