import{Q as _,T as f,o as y,f as h,a as l,u as o,w as u,F as v,Z as b,b as e,e as w,d as x}from"./app-B270toMR.js";import{_ as k}from"./AuthenticatedLayout-GIhEh712.js";import{_ as n,a as m,b as i}from"./TextInput-CzsmIAEQ.js";import{P as V}from"./PrimaryButton-CIxJEnkG.js";import"./ApplicationLogo-aUVJfE9o.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const S={class:"py-12"},N={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 relative"},P={class:"bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg"},E=e("header",null,[e("h2",{class:"text-lg font-medium text-gray-900"}," Update Setting "),e("p",{class:"mt-1 text-sm text-gray-600"}," Update your account's setting information. ")],-1),U={class:"flex justify-start gap-2"},B={class:"p-5 bg-gray-700"},$=["src"],C={class:"p-5"},j=["src"],F=e("div",null,null,-1),I={class:"flex items-center gap-4"},W={__name:"Setting",props:{setting:Object},setup(p){const r=p,c=_().props.generalSetting,t=f({companyName:r.setting.company_name,logo_black:null,logo_white:null,companyEmail:r.setting.company_email,companyPhone:r.setting.company_phone});function d(){t.post(route("settings.update"),{onSuccess:g=>{location.reload()}})}return(g,s)=>(y(),h(v,null,[l(o(b),{title:"Settings"}),l(k,null,{default:u(()=>[e("div",S,[e("div",N,[e("div",P,[e("section",null,[E,e("form",{class:"mt-6 space-y-6",enctype:"multipart/form-data",onSubmit:w(d,["prevent"])},[e("div",null,[l(n,{for:"name",value:"Site Name"}),l(m,{id:"name",modelValue:o(t).companyName,"onUpdate:modelValue":s[0]||(s[0]=a=>o(t).companyName=a),type:"text",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),l(i,{class:"mt-2",message:o(t).errors.companyName},null,8,["message"])]),e("div",U,[e("div",null,[l(n,{for:"email",value:"Company Email"}),l(m,{id:"email",modelValue:o(t).companyEmail,"onUpdate:modelValue":s[1]||(s[1]=a=>o(t).companyEmail=a),type:"email",class:"mt-1 block w-full"},null,8,["modelValue"]),l(i,{class:"mt-2",message:o(t).errors.companyEmail},null,8,["message"])]),e("div",null,[l(n,{for:"phone",value:"Company Phone"}),l(m,{id:"phone",modelValue:o(t).companyPhone,"onUpdate:modelValue":s[2]||(s[2]=a=>o(t).companyPhone=a),type:"tel",class:"mt-1 block w-full"},null,8,["modelValue"]),l(i,{class:"mt-2",message:o(t).errors.companyPhone},null,8,["message"])])]),e("div",null,[l(n,{for:"logo_white",value:"Logo White"}),l(m,{id:"logo_white",type:"file",onInput:s[3]||(s[3]=a=>o(t).logo_white=a.target.files[0]),class:"mt-1 block w-full"}),l(i,{class:"mt-2",message:o(t).errors.logo_white},null,8,["message"])]),e("div",B,[e("img",{src:o(c).logo_white,class:"h-20"},null,8,$)]),e("div",null,[l(n,{for:"logo_black",value:"Logo Black"}),l(m,{id:"logo_black",type:"file",onInput:s[4]||(s[4]=a=>o(t).logo_black=a.target.files[0]),class:"mt-1 block w-full"}),l(i,{class:"mt-2",message:o(t).errors.logo_black},null,8,["message"])]),e("div",C,[e("img",{src:o(c).logo_black,class:"h-20"},null,8,j)]),F,e("div",I,[l(V,null,{default:u(()=>[x(" Update ")]),_:1})])],32)])])])])]),_:1})],64))}};export{W as default};