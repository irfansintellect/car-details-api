import{_ as B}from"./AuthenticatedLayout-BRJbkn-D.js";import{k as U,o as c,c as A,w as C,f as g,m as v,b as t,l as b,r as P,F as x,p as y,t as o,g as R,q as k,a as f,u as w,Z as D,O as E}from"./app-OU-YsYzU.js";import{_ as N}from"./CarDetails-ra7RJVQo.js";import"./ApplicationLogo-JYhhBt4x.js";const O={emits:["pagination-change-page"],props:{data:{type:Object,default:()=>{}},limit:{type:Number,default:0},keepLength:{type:Boolean,default:!1}},computed:{isApiResource(){return!!this.data.meta},currentPage(){var e;return this.isApiResource?this.data.meta.current_page:(e=this.data.current_page)!=null?e:null},firstPageUrl(){var e,a,s,l,n;return(n=(l=(a=this.data.first_page_url)!=null?a:(e=this.data.meta)==null?void 0:e.first_page_url)!=null?l:(s=this.data.links)==null?void 0:s.first)!=null?n:null},from(){var e;return this.isApiResource?this.data.meta.from:(e=this.data.from)!=null?e:null},lastPage(){var e;return this.isApiResource?this.data.meta.last_page:(e=this.data.last_page)!=null?e:null},lastPageUrl(){var e,a,s,l,n;return(n=(l=(a=this.data.last_page_url)!=null?a:(e=this.data.meta)==null?void 0:e.last_page_url)!=null?l:(s=this.data.links)==null?void 0:s.last)!=null?n:null},nextPageUrl(){var e,a,s,l,n;return(n=(l=(a=this.data.next_page_url)!=null?a:(e=this.data.meta)==null?void 0:e.next_page_url)!=null?l:(s=this.data.links)==null?void 0:s.next)!=null?n:null},perPage(){var e;return this.isApiResource?this.data.meta.per_page:(e=this.data.per_page)!=null?e:null},prevPageUrl(){var e,a,s,l,n;return(n=(l=(a=this.data.prev_page_url)!=null?a:(e=this.data.meta)==null?void 0:e.prev_page_url)!=null?l:(s=this.data.links)==null?void 0:s.prev)!=null?n:null},to(){var e;return this.isApiResource?this.data.meta.to:(e=this.data.to)!=null?e:null},total(){var e;return this.isApiResource?this.data.meta.total:(e=this.data.total)!=null?e:null},pageRange(){if(this.limit===-1)return 0;if(this.limit===0)return this.lastPage;for(var e=this.currentPage,a=this.keepLength,s=this.lastPage,l=this.limit,n=e-l,m=e+l,p=(l+2)*2,i=(l+2)*2-1,d=[],h=[],r,u=1;u<=s;u++)(u===1||u===s||u>=n&&u<=m||a&&u<p&&e<p-2||a&&u>s-i&&e>s-i+2)&&d.push(u);return d.forEach(function(_){r&&(_-r===2?h.push(r+1):_-r!==1&&h.push("...")),h.push(_),r=_}),h}},methods:{previousPage(){this.selectPage(this.currentPage-1)},nextPage(){this.selectPage(this.currentPage+1)},selectPage(e){e==="..."||e===this.currentPage||this.$emit("pagination-change-page",e)}},render(){return this.$slots.default({data:this.data,limit:this.limit,computed:{isApiResource:this.isApiResource,currentPage:this.currentPage,firstPageUrl:this.firstPageUrl,from:this.from,lastPage:this.lastPage,lastPageUrl:this.lastPageUrl,nextPageUrl:this.nextPageUrl,perPage:this.perPage,prevPageUrl:this.prevPageUrl,to:this.to,total:this.total,pageRange:this.pageRange},prevButtonEvents:{click:e=>{e.preventDefault(),this.previousPage()}},nextButtonEvents:{click:e=>{e.preventDefault(),this.nextPage()}},pageButtonEvents:e=>({click:a=>{a.preventDefault(),this.selectPage(e)}})})}},$=(e,a)=>{const s=e.__vccOpts||e;for(const[l,n]of a)s[l]=n;return s},j={compatConfig:{MODE:3},inheritAttrs:!1,emits:["pagination-change-page"],components:{RenderlessPagination:O},props:{data:{type:Object,default:()=>{}},limit:{type:Number,default:0},keepLength:{type:Boolean,default:!1},itemClasses:{type:Array,default:()=>["bg-white","text-gray-500","border-gray-300","hover:bg-gray-50"]},activeClasses:{type:Array,default:()=>["bg-blue-50","border-blue-500","text-blue-600"]}},methods:{onPaginationChangePage(e){this.$emit("pagination-change-page",e)}}},L=["disabled"],z=t("span",{class:"sr-only"},"Previous",-1),V=t("svg",{class:"w-5 h-5","aria-hidden":"true",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15.75 19.5L8.25 12l7.5-7.5"})],-1),S=["aria-current","disabled"],M=["disabled"],Z=t("span",{class:"sr-only"},"Next",-1),F=t("svg",{class:"w-5 h-5","aria-hidden":"true",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 4.5l7.5 7.5-7.5 7.5"})],-1);function T(e,a,s,l,n,m){const p=U("RenderlessPagination");return c(),A(p,{data:s.data,limit:s.limit,"keep-length":s.keepLength,onPaginationChangePage:m.onPaginationChangePage},{default:C(i=>[i.computed.total>i.computed.perPage?(c(),g("nav",v({key:0},e.$attrs,{class:"inline-flex -space-x-px rounded-md shadow-sm isolate ltr:flex-row rtl:flex-row-reverse","aria-label":"Pagination"}),[t("button",v({class:["relative inline-flex items-center px-2 py-2 text-sm font-medium border rounded-l-md focus:z-20 disabled:opacity-50",s.itemClasses],disabled:!i.computed.prevPageUrl},b(i.prevButtonEvents,!0)),[P(e.$slots,"prev-nav",{},()=>[z,V])],16,L),(c(!0),g(x,null,y(i.computed.pageRange,(d,h)=>(c(),g("button",v({class:["relative inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-20",[d==i.computed.currentPage?s.activeClasses:s.itemClasses,d==i.computed.currentPage?"z-30":""]],"aria-current":i.computed.currentPage?"page":null,key:h},b(i.pageButtonEvents(d),!0),{disabled:d===i.computed.currentPage}),o(d),17,S))),128)),t("button",v({class:["relative inline-flex items-center px-2 py-2 text-sm font-medium border rounded-r-md focus:z-20 disabled:opacity-50",s.itemClasses],disabled:!i.computed.nextPageUrl},b(i.nextButtonEvents,!0)),[P(e.$slots,"next-nav",{},()=>[Z,F])],16,M)],16)):R("",!0)]),_:3},8,["data","limit","keep-length","onPaginationChangePage"])}const H=$(j,[["render",T]]),I={class:"py-12"},J={class:"w-full mx-auto sm:px-6 lg:px-8 relative"},K={class:"bg-white relative overflow-x-auto shadow-md sm:rounded-lg"},Q={key:0,class:"w-full text-sm text-left rtl:text-right"},W=t("thead",null,[t("tr",null,[t("th",{class:"border p-2 text-sm"},"Title"),t("th",{class:"border p-2 text-sm"},"Name"),t("th",{class:"border p-2 text-sm"},"Email"),t("th",{class:"border p-2 text-sm"},"Phone"),t("th",{class:"border p-2 text-sm"},"DOB"),t("th",{class:"border p-2 text-sm"}," Vehicle Value "),t("th",{class:"border p-2 text-sm"},"Owned Since"),t("th",{class:"border p-2 text-sm"}," PCP Taken Out "),t("th",{class:"border p-2 text-sm"},"Dealers Name"),t("th",{class:"border p-2 text-sm"},"Lenders Name"),t("th",{class:"border p-2 text-sm"},"Created Date"),t("th",{class:"border p-2 text-sm"},"Action")])],-1),X={class:"border p-2"},Y={class:"border p-2"},G={class:"border p-2"},q={class:"border p-2"},ee={class:"border p-2"},te={class:"border p-2"},se={class:"border p-2"},ae={class:"border p-2"},le={class:"border p-2"},re={class:"border p-2"},ne={class:"border p-2"},ie={class:"border p-2"},oe=["onClick"],de={key:1,class:"p-5"},ue={class:"my-5"},ce={key:0},pe=t("div",{class:"fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-60 z-10"},null,-1),he={class:"absolute z-20 -top-10 right-0 left-0 flex justify-center items-center"},fe={__name:"Dashboard",props:{quries:Object},setup(e){const a=k({}),s=k(!1);function l(p){a.value=p,s.value=!0}function n(p){return E.visit("/dashboard?page="+p)}const m=e;return(p,i)=>(c(),g(x,null,[f(w(D),{title:"Dashboard"}),f(B,null,{default:C(()=>{var d,h;return[t("div",I,[t("div",J,[t("div",K,[((d=m.quries)==null?void 0:d.data.length)>0?(c(),g("table",Q,[W,t("tbody",null,[(c(!0),g(x,null,y((h=m.quries)==null?void 0:h.data,r=>(c(),g("tr",{key:r.id},[t("td",X,o(r.title),1),t("td",Y,o(r.name),1),t("td",G,o(r.email),1),t("td",q,o(r.phone),1),t("td",ee,o(r.dob),1),t("td",te,o(r.vehicle_value),1),t("td",se,o(r.owned_since),1),t("td",ae,o(r.pcp_taken_out),1),t("td",le,o(r.dealers_name),1),t("td",re,o(r.lenders_name),1),t("td",ne,o(r.created_at),1),t("td",ie,[t("button",{onClick:u=>l(r),class:"bg-indigo-700 text-white p-1 rounded shadow-sm"}," View ",8,oe)])]))),128))])])):(c(),g("div",de," No records found! ")),t("div",ue,[f(w(H),{data:m.quries,onPaginationChangePage:n},null,8,["data"])])]),s.value?(c(),g("div",ce,[pe,t("div",he,[f(N,{form:a.value,"onUpdate:isShowCarDetail":i[0]||(i[0]=r=>s.value=r)},null,8,["form"])])])):R("",!0)])])]}),_:1})],64))}};export{fe as default};