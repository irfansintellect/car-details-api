import{T as m,o as l,c as d,w as t,a,u as o,Z as c,b as e,d as p,n as u,e as f}from"./app-Dyp9vMfg.js";import{_}from"./GuestLayout-Ulpsqn-d.js";import{_ as w,a as b,b as x}from"./TextInput-EX03kla0.js";import{P as g}from"./PrimaryButton-fLd6ka-S.js";import"./ApplicationLogo-BWYdYTVB.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const h=e("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),y={class:"flex justify-end mt-4"},T={__name:"ConfirmPassword",setup(P){const s=m({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(V,r)=>(l(),d(_,null,{default:t(()=>[a(o(c),{title:"Confirm Password"}),h,e("form",{onSubmit:f(i,["prevent"])},[e("div",null,[a(w,{for:"password",value:"Password"}),a(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:o(s).password,"onUpdate:modelValue":r[0]||(r[0]=n=>o(s).password=n),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(x,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",y,[a(g,{class:u(["ms-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:t(()=>[p(" Confirm ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{T as default};
