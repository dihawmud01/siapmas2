import Chart from 'chart.js/auto';
import * as echarts from 'echarts';
import { select } from '../helpers/dom-utils.js';

const mainContainer = select('#main');
if (mainContainer) {
    setTimeout(() => {
        new ResizeObserver(function () {
            select('.echart', true).forEach((getEchart) => {
                echarts.getInstanceByDom(getEchart);
            });
        }).observe(mainContainer);
    }, 200);
}

window.Chart = Chart;
window.echarts = echarts;
