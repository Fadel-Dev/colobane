import{r as d,v as x,d as s,b as o,u as t,w as m,F as c,o as r,X as h,a as i,f as n,m as y,n as C,A as w}from"./app-8596da2d.js";import{A as V}from"./AuthenticationCard-d0824127.js";import{_ as $}from"./AuthenticationCardLogo-21e9c9d1.js";import{_ as p}from"./InputError-accd350c.js";import{_ as v}from"./InputLabel-9d6abe1d.js";import{_ as I}from"./PrimaryButton-2398beb5.js";import{_ as g}from"./TextInput-ecb9bf03.js";import"./_plugin-vue_export-helper-c27b6911.js";const T={class:"mb-4 text-sm text-gray-600"},U=["onSubmit"],A={key:0},B={key:1},F={class:"flex items-center justify-end mt-4"},N=["onClick"],D={__name:"TwoFactorChallenge",setup(P){const a=d(!1),e=x({code:"",recovery_code:""}),f=d(null),_=d(null),k=async()=>{a.value^=!0,await w(),a.value?(f.value.focus(),e.code=""):(_.value.focus(),e.recovery_code="")},b=()=>{e.post(route("two-factor.login"))};return(R,l)=>(r(),s(c,null,[o(t(h),{title:"Two-factor Confirmation"}),o(V,null,{logo:m(()=>[o($)]),default:m(()=>[i("div",T,[a.value?(r(),s(c,{key:1},[n(" Please confirm access to your account by entering one of your emergency recovery codes. ")],64)):(r(),s(c,{key:0},[n(" Please confirm access to your account by entering the authentication code provided by your authenticator application. ")],64))]),i("form",{onSubmit:y(b,["prevent"])},[a.value?(r(),s("div",B,[o(v,{for:"recovery_code",value:"Recovery Code"}),o(g,{id:"recovery_code",ref_key:"recoveryCodeInput",ref:f,modelValue:t(e).recovery_code,"onUpdate:modelValue":l[1]||(l[1]=u=>t(e).recovery_code=u),type:"text",class:"mt-1 block w-full",autocomplete:"one-time-code"},null,8,["modelValue"]),o(p,{class:"mt-2",message:t(e).errors.recovery_code},null,8,["message"])])):(r(),s("div",A,[o(v,{for:"code",value:"Code"}),o(g,{id:"code",ref_key:"codeInput",ref:_,modelValue:t(e).code,"onUpdate:modelValue":l[0]||(l[0]=u=>t(e).code=u),type:"text",inputmode:"numeric",class:"mt-1 block w-full",autofocus:"",autocomplete:"one-time-code"},null,8,["modelValue"]),o(p,{class:"mt-2",message:t(e).errors.code},null,8,["message"])])),i("div",F,[i("button",{type:"button",class:"text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer",onClick:y(k,["prevent"])},[a.value?(r(),s(c,{key:1},[n(" Use an authentication code ")],64)):(r(),s(c,{key:0},[n(" Use a recovery code ")],64))],8,N),o(I,{class:C(["ml-4",{"opacity-25":t(e).processing}]),disabled:t(e).processing},{default:m(()=>[n(" Log in ")]),_:1},8,["class","disabled"])])],40,U)]),_:1})],64))}};export{D as default};