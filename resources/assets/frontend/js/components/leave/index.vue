<template>
    <div class="leave-container">
		<div class="leave-input">
			<!-- <MavonEditor v-model="formData.content" :ishljs = "true" :subfield="false" :toolbars="toolbars" style="min-height: 200px"></MavonEditor> -->
			<textarea class="leave-textarea" v-model="formData.content" placeholder="请输入留言内容"></textarea>
			<div class="leave-submit">
				<input type="text" placeholder="请输入您的邮箱地址" class="ub-input leave-mail-input" v-model="formData.mail">
				<button class="ub-btn" @click="save">提交</button>
			</div>
		</div>
		<div class="leave-lists">
			<h2 class="ub-h2">最近留言</h2>
			<ul class="leave-ul">
				<template v-for="lists in data">
					<li class="leave-li" v-for="list in lists" :key="list.id">
						<a href="javascript:;" class="ub-user">{{list.address | defaultValue('未知地区')}} 网友(<span>{{list.created_at}}</span>)：</a>
						<span class="ub-content">{{list.content}}</span>
					</li>
				</template>
			</ul>
			<p class="load-more" v-if="hasMore"><a href="javascript:;" @click="loadMore">更多...</a></p>
        	<p class="load-more" v-if="!hasMore"><a href="javascript:;">没有更多了...</a></p>
		</div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/leave/index.scss";
</style> 
<script src="../../components-js/leave/index.js"></script>