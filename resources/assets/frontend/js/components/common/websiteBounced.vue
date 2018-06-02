<template>
    <div id="website-bounced" class="website-bounced" v-bind:class="{ 'website-bounced-pc-animate': bouncedPcVisit, 'website-bounced-mobile-animate': bouncedMobileVisit }">
        <div class="website-bounced-content">
            <div class="bounced-menu">
                <ul>
                    <li><a class="active" href="javascript:;">所有文章</a></li>
                    <li><a href="javascript:;">关于我</a></li>
                </ul>
            </div>
            <div class="bounced-search">
                <input type="text" placeholder="Global search ...">
            </div>
            <div class="article-tags">
                <p class="tags-switch"><a href="javascript:;">关闭分类</a></p>
                <div class="tags-show">
                    <ul>
                        <li><a href="javascript:;">PHP</a></li>
                        <li><a href="javascript:;">C</a></li>
                        <li><a href="javascript:;">Js</a></li>
                        <li><a href="javascript:;">Css</a></li>
                        <li><a href="javascript:;">github</a></li>
                        <li><a href="javascript:;">Linux</a></li>
                        <li><a href="javascript:;">游记</a></li>
                        <li><a href="javascript:;">PHP</a></li>
                        <li><a href="javascript:;">C</a></li>
                        <li><a href="javascript:;">Js</a></li>
                        <li><a href="javascript:;">Css</a></li>
                        <li><a href="javascript:;">github</a></li>
                        <li><a href="javascript:;">Linux</a></li>
                        <li><a href="javascript:;">游记</a></li>
                        <li><a href="javascript:;">PHP</a></li>
                        <li><a href="javascript:;">C</a></li>
                        <li><a href="javascript:;">Js</a></li>
                        <li><a href="javascript:;">Css</a></li>
                        <li><a href="javascript:;">github</a></li>
                        <li><a href="javascript:;">Linux</a></li>
                        <li><a href="javascript:;">游记</a></li>
                    </ul>
                </div>
            </div>
            <div class="recommend-lists">
                <h3><a href="javascript:;">推荐文章(10)</a></h3>
                <div class="recommend-content article-recommend">
                    <ul>
                        <li>
                            <a href="javascript:;">新疆游记</a>
                            <p>
                                <span>2017-03-19</span>
                                <span>游记</span>
                            </p>
                        </li>
                        <li>
                            <a href="javascript:;">PHP面试精选整理</a>
                            <p>
                                <span>2017-03-19</span>
                                <span>PHP</span>
                            </p>
                        </li>
                    </ul>
                </div>
                <h3><a href="javascript:;">最近留言(5)</a></h3>
                <div class="recommend-content leave-new">
                    <ul>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                        <li><a href="javascript:;"><span class="leave-user">高山流水：</span>博客真漂亮</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Leeter：</span>真心好看</a></li>
                        <li><a href="javascript:;"><span class="leave-user">Similt：</span>赞</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/websiteBounced.scss";
</style>
<script src="../../components-js/common/websiteBounced.js"></script>