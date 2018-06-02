/**
 * 根据对象内容获取某一个字段
 * @param  {string} val      value值
 * @param  {Object} options  对象
 * @param  {string} objKey   对象的key字段名称
 * @param  {string} objValue 对象的value字段名称
 * @param  {string} text     没有匹配到返回默认值
 * @return {string}
 */
export function filterOptions(val, options, objKey, objValue, text = '-') {
    if (val == undefined || options == undefined) {
        return text;
    }
    if (Object.keys(options).length == 0 ) {
        return text;
    }
    options.forEach(function(item) {
        if (val == item[objKey]) {
            return text = item[objValue];
        }
    });
    return text;
}

/**
 * 截取字符串，过滤html标签
 * @param  {string} str 可能含html标签
 * @param  {int} start   开始截取位置
 * @param  {int} length  截取字符长度
 * @return {string}
 */
export function subString(str, sub_start, sub_length) {
    if (str === null || str === undefined) {
        return '';
    }
    str = str.replace(/<\/?[^>]*>/g, ''); //去除HTML tag
    str = str.replace(/[ | ]*\n/g, '\n'); //去除行尾空白
    str = str.replace(/\n[\s| | ]*\r/g, '\n'); //去除多余空行
    str = str.replace(/&nbsp;/ig, ''); //去掉&nbsp;
    return str.length > sub_length ? str.substring(sub_start, sub_length) + '...' : str;
}

/**
 * 获取总数
 * @param  {array} lists
 * @return {string}
 */
export function getCount(lists, key = '', value = 1) {
    let count = 0;
    if (lists == undefined) {
        return count;
    }
    if (Array.isArray(lists)) {
        if (key === '') {
            return lists.length;
        }
        lists.forEach(response => {
            if (response[key] == value) {
                count++;
            }
        });
        return count;
    }
    return getCount(Object.keys(lists), key, value);
}

/**
 * 默认值
 * @param  {string} value
 * @param  {string} default
 * @return {string}
 */
export function defaultValue(value, defaultString) {
    if (value == undefined || value === '') {
        return defaultString;
    }
    return value;
}