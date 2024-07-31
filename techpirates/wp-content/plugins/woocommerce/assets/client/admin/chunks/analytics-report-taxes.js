"use strict";(globalThis.webpackChunk_wcAdmin_webpackJsonp=globalThis.webpackChunk_wcAdmin_webpackJsonp||[]).push([[9792],{86179:(e,t,r)=>{r.d(t,{Z:()=>x});var a=r(69307),o=r(65736),s=r(94333),n=r(69771),i=r(9818),l=r(92819),c=r(7862),m=r.n(c),d=r(86020),u=r(67221),p=r(81921),y=r(17844),g=r(26707),h=r(10431);function _(e,t,r={}){if(!e||0===e.length)return null;const a=e.slice(0),o=a.pop();if(o.showFilters(t,r)){const e=(0,h.flattenFilters)(o.filters),r=t[o.param]||o.defaultValue||"all";return(0,l.find)(e,{value:r})}return _(a,t,r)}function b(e){return t=>(0,n.format)(e,t)}class f extends a.Component{shouldComponentUpdate(e){return e.isRequesting!==this.props.isRequesting||e.primaryData.isRequesting!==this.props.primaryData.isRequesting||e.secondaryData.isRequesting!==this.props.secondaryData.isRequesting||!(0,l.isEqual)(e.query,this.props.query)}getItemChartData(){const{primaryData:e,selectedChart:t}=this.props;return e.data.intervals.map((function(e){const r={};return e.subtotals.segments.forEach((function(e){if(e.segment_label){const a=r[e.segment_label]?e.segment_label+" (#"+e.segment_id+")":e.segment_label;r[e.segment_id]={label:a,value:e.subtotals[t.key]||0}}})),{date:(0,n.format)("Y-m-d\\TH:i:s",e.date_start),...r}}))}getTimeChartData(){const{query:e,primaryData:t,secondaryData:r,selectedChart:a,defaultDateRange:o}=this.props,s=(0,p.getIntervalForQuery)(e,o),{primary:i,secondary:l}=(0,p.getCurrentDates)(e,o);return t.data.intervals.map((function(t,o){const c=(0,p.getPreviousDate)(t.date_start,i.after,l.after,e.compare,s),m=r.data.intervals[o];return{date:(0,n.format)("Y-m-d\\TH:i:s",t.date_start),primary:{label:`${i.label} (${i.range})`,labelDate:t.date_start,value:t.subtotals[a.key]||0},secondary:{label:`${l.label} (${l.range})`,labelDate:c.format("YYYY-MM-DD HH:mm:ss"),value:m&&m.subtotals[a.key]||0}}}))}getTimeChartTotals(){const{primaryData:e,secondaryData:t,selectedChart:r}=this.props;return{primary:(0,l.get)(e,["data","totals",r.key],null),secondary:(0,l.get)(t,["data","totals",r.key],null)}}renderChart(e,t,r,s){const{emptySearchResults:n,filterParam:i,interactiveLegend:l,itemsLabel:c,legendPosition:m,path:y,query:g,selectedChart:h,showHeaderControls:_,primaryData:f,defaultDateRange:x}=this.props,C=(0,p.getIntervalForQuery)(g,x),v=(0,p.getAllowedIntervalsForQuery)(g,x),R=(0,p.getDateFormatsForInterval)(C,f.data.intervals.length,{type:"php"}),q=n?(0,o.__)("No data for the current search","woocommerce"):(0,o.__)("No data for the selected date range","woocommerce"),{formatAmount:w,getCurrencyConfig:S}=this.context;return(0,a.createElement)(d.Chart,{allowedIntervals:v,data:r,dateParser:"%Y-%m-%dT%H:%M:%S",emptyMessage:q,filterParam:i,interactiveLegend:l,interval:C,isRequesting:t,itemsLabel:c,legendPosition:m,legendTotals:s,mode:e,path:y,query:g,screenReaderFormat:b(R.screenReaderFormat),showHeaderControls:_,title:h.label,tooltipLabelFormat:b(R.tooltipLabelFormat),tooltipTitle:"time-comparison"===e&&h.label||null,tooltipValueFormat:(0,u.getTooltipValueFormat)(h.type,w),chartType:(0,p.getChartTypeForQuery)(g),valueType:h.type,xFormat:b(R.xFormat),x2Format:b(R.x2Format),currency:S()})}renderItemComparison(){const{isRequesting:e,primaryData:t}=this.props;if(t.isError)return(0,a.createElement)(g.Z,null);const r=e||t.isRequesting,o=this.getItemChartData();return this.renderChart("item-comparison",r,o)}renderTimeComparison(){const{isRequesting:e,primaryData:t,secondaryData:r}=this.props;if(!t||t.isError||r.isError)return(0,a.createElement)(g.Z,null);const o=e||t.isRequesting||r.isRequesting,s=this.getTimeChartData(),n=this.getTimeChartTotals();return this.renderChart("time-comparison",o,s,n)}render(){const{mode:e}=this.props;return"item-comparison"===e?this.renderItemComparison():this.renderTimeComparison()}}f.contextType=y.CurrencyContext,f.propTypes={filters:m().array,isRequesting:m().bool,itemsLabel:m().string,limitProperties:m().array,mode:m().string,path:m().string.isRequired,primaryData:m().object,query:m().object.isRequired,secondaryData:m().object,selectedChart:m().shape({key:m().string.isRequired,label:m().string.isRequired,order:m().oneOf(["asc","desc"]),orderby:m().string,type:m().oneOf(["average","number","currency"]).isRequired}).isRequired},f.defaultProps={isRequesting:!1,primaryData:{data:{intervals:[]},isError:!1,isRequesting:!1},secondaryData:{data:{intervals:[]},isError:!1,isRequesting:!1}};const x=(0,s.compose)((0,i.withSelect)(((e,t)=>{const{charts:r,endpoint:a,filters:o,isRequesting:s,limitProperties:n,query:i,advancedFilters:c}=t,m=n||[a],d=_(o,i),p=(0,l.get)(d,["settings","param"]),y=t.mode||function(e,t){if(e&&t){const r=(0,l.get)(e,["settings","param"]);if(!r||Object.keys(t).includes(r))return(0,l.get)(e,["chartMode"])}return null}(d,i)||"time-comparison",{woocommerce_default_date_range:g}=e(u.SETTINGS_STORE_NAME).getSetting("wc_admin","wcAdminSettings"),h=e(u.REPORTS_STORE_NAME),b={mode:y,filterParam:p,defaultDateRange:g};if(s)return b;const f=m.some((e=>i[e]&&i[e].length));if(i.search&&!f)return{...b,emptySearchResults:!0};const x=r&&r.map((e=>e.key)),C=(0,u.getReportChartData)({endpoint:a,dataType:"primary",query:i,selector:h,limitBy:m,filters:o,advancedFilters:c,defaultDateRange:g,fields:x});if("item-comparison"===y)return{...b,primaryData:C};const v=(0,u.getReportChartData)({endpoint:a,dataType:"secondary",query:i,selector:h,limitBy:m,filters:o,advancedFilters:c,defaultDateRange:g,fields:x});return{...b,primaryData:C,secondaryData:v}})))(f)},31634:(e,t,r)=>{r.d(t,{Z:()=>b});var a=r(69307),o=r(65736),s=r(94333),n=r(9818),i=r(7862),l=r.n(i),c=r(10431),m=r(86020),d=r(81595),u=r(67221),p=r(81921),y=r(14599),g=r(17844),h=r(26707);class _ extends a.Component{formatVal(e,t){const{formatAmount:r,getCurrencyConfig:a}=this.context;return"currency"===t?r(e):(0,d.formatValue)(a(),t,e)}getValues(e,t){const{emptySearchResults:r,summaryData:a}=this.props,{totals:o}=a,s=o.primary?o.primary[e]:0,n=o.secondary?o.secondary[e]:0,i=r?0:s,l=r?0:n;return{delta:(0,d.calculateDelta)(i,l),prevValue:this.formatVal(l,t),value:this.formatVal(i,t)}}render(){const{charts:e,query:t,selectedChart:r,summaryData:s,endpoint:n,report:i,defaultDateRange:l}=this.props,{isError:d,isRequesting:u}=s;if(d)return(0,a.createElement)(h.Z,null);if(u)return(0,a.createElement)(m.SummaryListPlaceholder,{numberOfItems:e.length});const{compare:g}=(0,p.getDateParamsFromQuery)(t,l);return(0,a.createElement)(m.SummaryList,null,(({onToggle:t})=>e.map((e=>{const{key:s,order:l,orderby:d,label:u,type:p,isReverseTrend:h,labelTooltipText:_}=e,b={chart:s};d&&(b.orderby=d),l&&(b.order=l);const f=(0,c.getNewPath)(b),x=r.key===s,{delta:C,prevValue:v,value:R}=this.getValues(s,p);return(0,a.createElement)(m.SummaryNumber,{key:s,delta:C,href:f,label:u,reverseTrend:h,prevLabel:"previous_period"===g?(0,o.__)("Previous period:","woocommerce"):(0,o.__)("Previous year:","woocommerce"),prevValue:v,selected:x,value:R,labelTooltipText:_,onLinkClickCallback:()=>{t&&t(),(0,y.recordEvent)("analytics_chart_tab_click",{report:i||n,key:s})}})}))))}}_.propTypes={charts:l().array.isRequired,endpoint:l().string.isRequired,limitProperties:l().array,query:l().object.isRequired,selectedChart:l().shape({key:l().string.isRequired,label:l().string.isRequired,order:l().oneOf(["asc","desc"]),orderby:l().string,type:l().oneOf(["average","number","currency"]).isRequired}).isRequired,summaryData:l().object,report:l().string},_.defaultProps={summaryData:{totals:{primary:{},secondary:{}},isError:!1}},_.contextType=g.CurrencyContext;const b=(0,s.compose)((0,n.withSelect)(((e,t)=>{const{charts:r,endpoint:a,limitProperties:o,query:s,filters:n,advancedFilters:i}=t,l=o||[a],c=l.some((e=>s[e]&&s[e].length));if(s.search&&!c)return{emptySearchResults:!0};const m=r&&r.map((e=>e.key)),{woocommerce_default_date_range:d}=e(u.SETTINGS_STORE_NAME).getSetting("wc_admin","wcAdminSettings");return{summaryData:(0,u.getSummaryNumbers)({endpoint:a,query:s,select:e,limitBy:l,filters:n,advancedFilters:i,defaultDateRange:d,fields:m}),defaultDateRange:d}})))(_)},70077:(e,t,r)=>{r.d(t,{O3:()=>d,be:()=>u,u8:()=>y});var a=r(65736),o=r(92694),s=r(75606),n=r(67221),i=r(9818),l=r(8887),c=r(1608);const{addCesSurveyForAnalytics:m}=(0,i.dispatch)(s.STORE_KEY),d=(0,o.applyFilters)("woocommerce_admin_taxes_report_charts",[{key:"total_tax",label:(0,a.__)("Total tax","woocommerce"),order:"desc",orderby:"total_tax",type:"currency"},{key:"order_tax",label:(0,a.__)("Order tax","woocommerce"),order:"desc",orderby:"order_tax",type:"currency"},{key:"shipping_tax",label:(0,a.__)("Shipping tax","woocommerce"),order:"desc",orderby:"shipping_tax",type:"currency"},{key:"orders_count",label:(0,a.__)("Orders","woocommerce"),order:"desc",orderby:"orders_count",type:"number"}]),u=(0,o.applyFilters)("woocommerce_admin_taxes_report_advanced_filters",{filters:{},title:(0,a._x)("Taxes match <select/> filters","A sentence describing filters for Taxes. See screen shot for context: https://cloudup.com/cSsUY9VeCVJ","woocommerce")}),p=[{label:(0,a.__)("All taxes","woocommerce"),value:"all"},{label:(0,a.__)("Comparison","woocommerce"),value:"compare-taxes",chartMode:"item-comparison",settings:{type:"taxes",param:"taxes",getLabels:(0,l.qc)(n.NAMESPACE+"/taxes",(e=>({id:e.id,key:e.id,label:(0,c.I)(e)}))),labels:{helpText:(0,a.__)("Check at least two tax codes below to compare","woocommerce"),placeholder:(0,a.__)("Search for tax codes to compare","woocommerce"),title:(0,a.__)("Compare Tax Codes","woocommerce"),update:(0,a.__)("Compare","woocommerce")},onClick:m}}];Object.keys(u.filters).length&&p.push({label:(0,a.__)("Advanced filters","woocommerce"),value:"advanced"});const y=(0,o.applyFilters)("woocommerce_admin_taxes_report_filters",[{label:(0,a.__)("Show","woocommerce"),staticParams:["chartType","paged","per_page"],param:"filter",showFilters:()=>!0,filters:p}])},79995:(e,t,r)=>{r.r(t),r.d(t,{default:()=>v});var a=r(69307),o=r(7862),s=r.n(o),n=r(65736),i=r(70077),l=r(29860),c=r(86179),m=r(31634),d=r(92819),u=r(86020),p=r(10431),y=r(81595),g=r(17844),h=r(1608),_=r(54994);class b extends a.Component{constructor(){super(),this.getHeadersContent=this.getHeadersContent.bind(this),this.getRowsContent=this.getRowsContent.bind(this),this.getSummary=this.getSummary.bind(this)}getHeadersContent(){return[{label:(0,n.__)("Tax code","woocommerce"),key:"tax_code",required:!0,isLeftAligned:!0,isSortable:!0},{label:(0,n.__)("Rate","woocommerce"),key:"rate",isSortable:!0,isNumeric:!0},{label:(0,n.__)("Total tax","woocommerce"),key:"total_tax",isSortable:!0},{label:(0,n.__)("Order tax","woocommerce"),key:"order_tax",isSortable:!0},{label:(0,n.__)("Shipping tax","woocommerce"),key:"shipping_tax",isSortable:!0},{label:(0,n.__)("Orders","woocommerce"),key:"orders_count",required:!0,defaultSort:!0,isSortable:!0,isNumeric:!0}]}getRowsContent(e){const{render:t,formatDecimal:r,getCurrencyConfig:o}=this.context;return(0,d.map)(e,(e=>{const{query:s}=this.props,{order_tax:n,orders_count:i,tax_rate:l,tax_rate_id:c,total_tax:m,shipping_tax:d}=e,g=(0,h.I)(e),_=(0,p.getPersistedQuery)(s),b=(0,p.getNewPath)(_,"/analytics/orders",{filter:"advanced",tax_rate_includes:c});return[{display:(0,a.createElement)(u.Link,{href:b,type:"wc-admin"},g),value:g},{display:l.toFixed(2)+"%",value:l},{display:t(m),value:r(m)},{display:t(n),value:r(n)},{display:t(d),value:r(d)},{display:(0,y.formatValue)(o(),"number",i),value:i}]}))}getSummary(e){const{tax_codes:t=0,total_tax:r=0,order_tax:a=0,shipping_tax:o=0,orders_count:s=0}=e,{formatAmount:i,getCurrencyConfig:l}=this.context,c=l();return[{label:(0,n._n)("tax code","tax codes",t,"woocommerce"),value:(0,y.formatValue)(c,"number",t)},{label:(0,n.__)("total tax","woocommerce"),value:i(r)},{label:(0,n.__)("order tax","woocommerce"),value:i(a)},{label:(0,n.__)("shipping tax","woocommerce"),value:i(o)},{label:(0,n._n)("order","orders",s,"woocommerce"),value:(0,y.formatValue)(c,"number",s)}]}render(){const{advancedFilters:e,filters:t,isRequesting:r,query:o}=this.props;return(0,a.createElement)(_.Z,{compareBy:"taxes",endpoint:"taxes",getHeadersContent:this.getHeadersContent,getRowsContent:this.getRowsContent,getSummary:this.getSummary,summaryFields:["tax_codes","total_tax","order_tax","shipping_tax","orders_count"],isRequesting:r,itemIdField:"tax_rate_id",query:o,searchBy:"taxes",tableQuery:{orderby:o.orderby||"tax_rate_id"},title:(0,n.__)("Taxes","woocommerce"),columnPrefsKey:"taxes_report_columns",filters:t,advancedFilters:e})}}b.contextType=g.CurrencyContext;const f=b;var x=r(93198);class C extends a.Component{getChartMeta(){const{query:e}=this.props,t="compare-taxes"===e.filter?"item-comparison":"time-comparison";return{itemsLabel:(0,n.__)("%d taxes","woocommerce"),mode:t}}render(){const{isRequesting:e,query:t,path:r}=this.props,{mode:o,itemsLabel:s}=this.getChartMeta(),n={...t};return"item-comparison"===o&&(n.segmentby="tax_rate_id"),(0,a.createElement)(a.Fragment,null,(0,a.createElement)(x.Z,{query:t,path:r,filters:i.u8,advancedFilters:i.be,report:"taxes"}),(0,a.createElement)(m.Z,{charts:i.O3,endpoint:"taxes",isRequesting:e,query:n,selectedChart:(0,l.Z)(t.chart,i.O3),filters:i.u8,advancedFilters:i.be}),(0,a.createElement)(c.Z,{charts:i.O3,filters:i.u8,advancedFilters:i.be,mode:o,endpoint:"taxes",query:n,path:r,isRequesting:e,itemsLabel:s,selectedChart:(0,l.Z)(t.chart,i.O3)}),(0,a.createElement)(f,{isRequesting:e,query:t,filters:i.u8,advancedFilters:i.be}))}}C.propTypes={query:s().object.isRequired};const v=C},1608:(e,t,r)=>{r.d(t,{I:()=>o});var a=r(65736);function o(e){return[e.country,e.state,e.name||(0,a.__)("TAX","woocommerce"),e.priority].map((e=>e.toString().toUpperCase().trim())).filter(Boolean).join("-")}},8887:(e,t,r)=>{r.d(t,{FI:()=>h,V1:()=>_,YC:()=>u,hQ:()=>p,jk:()=>y,oC:()=>g,qc:()=>d,uC:()=>b});var a=r(96483),o=r(86989),s=r.n(o),n=r(92819),i=r(10431),l=r(67221),c=r(1608),m=r(61935);function d(e,t=n.identity){return function(r="",o){const n="function"==typeof e?e(o):e,l=(0,i.getIdsFromQuery)(r);if(l.length<1)return Promise.resolve([]);const c={include:l.join(","),per_page:l.length};return s()({path:(0,a.addQueryArgs)(n,c)}).then((e=>e.map(t)))}}d(l.NAMESPACE+"/products/attributes",(e=>({key:e.id,label:e.name})));const u=d(l.NAMESPACE+"/products/categories",(e=>({key:e.id,label:e.name}))),p=d(l.NAMESPACE+"/coupons",(e=>({key:e.id,label:e.code}))),y=d(l.NAMESPACE+"/customers",(e=>({key:e.id,label:e.name}))),g=d(l.NAMESPACE+"/products",(e=>({key:e.id,label:e.name}))),h=d(l.NAMESPACE+"/taxes",(e=>({key:e.id,label:(0,c.I)(e)})));function _({attributes:e,name:t}){const r=(0,m.O3)("variationTitleAttributesSeparator"," - ");if(t&&t.indexOf(r)>-1)return t;const a=(e||[]).map((({option:e})=>e)).join(", ");return a?t+r+a:t}const b=d((({products:e})=>e?l.NAMESPACE+`/products/${e}/variations`:l.NAMESPACE+"/variations"),(e=>({key:e.id,label:_(e)})))},29860:(e,t,r)=>{r.d(t,{Z:()=>o});var a=r(92819);function o(e,t=[]){return(0,a.find)(t,{key:e})||t[0]}}}]);