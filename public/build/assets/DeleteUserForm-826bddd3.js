import{r as c,v as _,c as v,w as e,o as w,f as o,a as m,b as r,u as t,R as h,n as x}from"./app-307758f9.js";import{_ as y}from"./Modal-19a6b77f.js";import{_ as u}from"./DangerButton-ce5c9383.js";import{_ as g}from"./DialogModal-76fca717.js";import{_ as k}from"./InputError-d0748cdf.js";import{_ as C}from"./SecondaryButton-d9c4affb.js";import{_ as S}from"./TextInput-f6b50972.js";import"./SectionTitle-fb1a9d90.js";import"./_plugin-vue_export-helper-c27b6911.js";const U=m("div",{class:"max-w-xl text-sm text-gray-600"}," Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver. ",-1),V={class:"mt-5"},$={class:"mt-4"},E={__name:"DeleteUserForm",setup(z){const a=c(!1),i=c(null),s=_({password:""}),d=()=>{a.value=!0,setTimeout(()=>i.value.focus(),250)},l=()=>{s.delete(route("current-user.destroy"),{preserveScroll:!0,onSuccess:()=>n(),onError:()=>i.value.focus(),onFinish:()=>s.reset()})},n=()=>{a.value=!1,s.reset()};return(b,p)=>(w(),v(y,null,{title:e(()=>[o(" Supprimer le compte ")]),description:e(()=>[o(" Supprimer définitivement votre compte. ")]),content:e(()=>[U,m("div",V,[r(u,{onClick:d},{default:e(()=>[o(" Supprimer le compte ")]),_:1})]),r(g,{show:a.value,onClose:n},{title:e(()=>[o(" Supprimer le compte ")]),content:e(()=>[o(" Êtes-vous sûr de vouloir supprimer votre compte ? Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte. "),m("div",$,[r(S,{ref_key:"passwordInput",ref:i,modelValue:t(s).password,"onUpdate:modelValue":p[0]||(p[0]=f=>t(s).password=f),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:h(l,["enter"])},null,8,["modelValue","onKeyup"]),r(k,{message:t(s).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[r(C,{onClick:n},{default:e(()=>[o(" Cancel ")]),_:1}),r(u,{class:x(["ml-3",{"opacity-25":t(s).processing}]),disabled:t(s).processing,onClick:l},{default:e(()=>[o(" Supprimer le compte ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{E as default};