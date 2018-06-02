<template>
    <div class="ub-infor-card">
        <Card :padding="0" style="height: 100%">
            <Row type="flex">
                <Col span="8" style="padding:0;margin:0;">
                <div class="card-left" :style="{background: cardLeftBgColor}">
                    <slot name="card-left-content"></slot>
                </div>
                </Col>
                <Col span="16" align="center">
                <div class="card-right">
                    <div class="card-right-content">
                        <p class="ub-header-text">{{cardHeaderText}}</p>
                        <p class="ub-body-text">{{cardBodyText}}</p>
                    </div>
                </div>
                </Col>
            </Row>
        </Card>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
.ub-infor-card {
    height: 100px;
    .ivu-row-flex {
        height: 100px;
    }
    .card-left {
        text-align: center;
        line-height: 100%;
        height: 100%;
        display: table;
        width: 100%;
        i {
            vertical-align: middle;
            display: table-cell;
            font-size: 40px;
            font-weight: 400;
            color: #fafafa;
        }
    }
    .card-right {
        height: 100%;
        display: table;
        text-align: center;
        .card-right-content {
            vertical-align: middle;
            display: table-cell;
            .ub-header-text {
                font-size: 30px;
                font-weight: 700;
                color: #2d8cf0;
            }
            .ub-body-text {
                color: #80848f;
                font-size: 12px;
            }
        }
    }
}
</style>
<script>
export default {
    props: {
        cardLeftBgColor: '',
        cardHeaderText: '',
        cardBodyText: '',
    },
    data() {
        return {};
    },
    method: {

    }
}
</script>