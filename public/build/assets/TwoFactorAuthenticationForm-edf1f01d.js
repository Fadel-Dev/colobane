import{r as p,E,o as t,d as s,a as i,B as H,b as a,w as o,f as r,t as C,R as P,n as x,A as N,v as j,x as I,G as O,c as y,u as _,e as u,F as Q,g as D,J as G,O as K}from"./app-307758f9.js";import{_ as U}from"./Modal-19a6b77f.js";import{_ as J}from"./DialogModal-76fca717.js";import{_ as B}from"./InputError-d0748cdf.js";import{_ as A}from"./PrimaryButton-336964ed.js";import{_ as S}from"./SecondaryButton-d9c4affb.js";import{_ as L}from"./TextInput-f6b50972.js";import{_ as W}from"./DangerButton-ce5c9383.js";import{_ as X}from"./InputLabel-d72e73d5.js";import"./SectionTitle-fb1a9d90.js";import"./_plugin-vue_export-helper-c27b6911.js";const Y={class:"mt-4"},g={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(w,{emit:k}){const l=p(!1),e=E({password:"",error:"",processing:!1}),c=p(null),h=()=>{axios.get(route("password.confirmation")).then(n=>{n.data.confirmed?k("confirmed"):(l.value=!0,setTimeout(()=>c.value.focus(),250))})},v=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),N().then(()=>k("confirmed"))}).catch(n=>{e.processing=!1,e.error=n.response.data.errors.password[0],c.value.focus()})},d=()=>{l.value=!1,e.password="",e.error=""};return(n,f)=>(t(),s("span",null,[i("span",{onClick:h},[H(n.$slots,"default")]),a(J,{show:l.value,onClose:d},{title:o(()=>[r(C(w.title),1)]),content:o(()=>[r(C(w.content)+" ",1),i("div",Y,[a(L,{ref_key:"passwordInput",ref:c,modelValue:e.password,"onUpdate:modelValue":f[0]||(f[0]=T=>e.password=T),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:P(v,["enter"])},null,8,["modelValue","onKeyup"]),a(B,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[a(S,{onClick:d},{default:o(()=>[r(" Cancel ")]),_:1}),a(A,{class:x(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:v},{default:o(()=>[r(C(w.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},Z={key:0,class:"text-lg font-medium text-gray-900"},ee={key:1,class:"text-lg font-medium text-gray-900"},te={key:2,class:"text-lg font-medium text-gray-900"},oe=i("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[i("p",null," Lorsque l'authentification à deux facteurs est activée, vous serez invité à saisir un jeton aléatoire sécurisé lors de l'authentification. Vous pouvez récupérer ce jeton depuis l'application Google Authenticator de votre téléphone. ")],-1),se={key:3},ae={key:0},re={class:"mt-4 max-w-xl text-sm text-gray-600"},ne={key:0,class:"font-semibold"},ie={key:1},le=["innerHTML"],ce={key:0,class:"mt-4 max-w-xl text-sm text-gray-600"},ue={class:"font-semibold"},de=["innerHTML"],fe={key:1,class:"mt-4"},me={key:1},pe=i("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[i("p",{class:"font-semibold"}," Stockez ces codes de récupération dans un gestionnaire de mots de passe sécurisé. Ils peuvent être utilisés pour récupérer l'accès à votre compte si votre dispositif d'authentification à deux facteurs est perdu. ")],-1),ve={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},_e={class:"mt-5"},he={key:0},ye={key:1},ze={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(w){const k=w,l=p(!1),e=p(!1),c=p(!1),h=p(null),v=p(null),d=p([]),n=j({code:""}),f=I(()=>{var m;return!l.value&&((m=G().props.auth.user)==null?void 0:m.two_factor_enabled)});O(f,()=>{f.value||(n.reset(),n.clearErrors())});const T=()=>{l.value=!0,K.post(route("two-factor.enable"),{},{preserveScroll:!0,onSuccess:()=>Promise.all([R(),q(),V()]),onFinish:()=>{l.value=!1,e.value=k.requiresConfirmation}})},R=()=>axios.get(route("two-factor.qr-code")).then(m=>{h.value=m.data.svg}),q=()=>axios.get(route("two-factor.secret-key")).then(m=>{v.value=m.data.secretKey}),V=()=>axios.get(route("two-factor.recovery-codes")).then(m=>{d.value=m.data}),F=()=>{n.post(route("two-factor.confirm"),{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,h.value=null,v.value=null}})},M=()=>{axios.post(route("two-factor.recovery-codes")).then(()=>V())},z=()=>{c.value=!0,K.delete(route("two-factor.disable"),{preserveScroll:!0,onSuccess:()=>{c.value=!1,e.value=!1}})};return(m,$)=>(t(),y(U,null,{title:o(()=>[r(" Authentification à deux facteurs ")]),description:o(()=>[r(" Ajoutez une sécurité supplémentaire à votre compte en utilisant l'authentification à deux facteurs. ")]),content:o(()=>[_(f)&&!e.value?(t(),s("h3",Z," Vous avez activé l'authentification à deux facteurs. ")):_(f)&&e.value?(t(),s("h3",ee," Terminez l'activation de l'authentification à deux facteurs. ")):(t(),s("h3",te," Vous n'avez pas activé l'authentification à deux facteurs. ")),oe,_(f)?(t(),s("div",se,[h.value?(t(),s("div",ae,[i("div",re,[e.value?(t(),s("p",ne," To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code. ")):(t(),s("p",ie," L'authentification à deux facteurs est maintenant activée. Scannez le code QR suivant à l'aide de l'application d'authentification de votre téléphone ou entrez la clé de configuration. "))]),i("div",{class:"mt-4",innerHTML:h.value},null,8,le),v.value?(t(),s("div",ce,[i("p",ue,[r(" Setup Key: "),i("span",{innerHTML:v.value},null,8,de)])])):u("",!0),e.value?(t(),s("div",fe,[a(X,{for:"code",value:"Code"}),a(L,{id:"code",modelValue:_(n).code,"onUpdate:modelValue":$[0]||($[0]=b=>_(n).code=b),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:P(F,["enter"])},null,8,["modelValue","onKeyup"]),a(B,{message:_(n).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),s("div",me,[pe,i("div",ve,[(t(!0),s(Q,null,D(d.value,b=>(t(),s("div",{key:b},C(b),1))),128))])])):u("",!0)])):u("",!0),i("div",_e,[_(f)?(t(),s("div",ye,[a(g,{onConfirmed:F},{default:o(()=>[e.value?(t(),y(A,{key:0,type:"button",class:x(["mr-3",{"opacity-25":l.value}]),disabled:l.value},{default:o(()=>[r(" Confirmez ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(g,{onConfirmed:M},{default:o(()=>[d.value.length>0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[r(" Régénérer les codes de récupération ")]),_:1})):u("",!0)]),_:1}),a(g,{onConfirmed:V},{default:o(()=>[d.value.length===0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[r(" Afficher les codes de récupération ")]),_:1})):u("",!0)]),_:1}),a(g,{onConfirmed:z},{default:o(()=>[e.value?(t(),y(S,{key:0,class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[r(" Annuler ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(g,{onConfirmed:z},{default:o(()=>[e.value?u("",!0):(t(),y(W,{key:0,class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[r(" Desactiver ")]),_:1},8,["class","disabled"]))]),_:1})])):(t(),s("div",he,[a(g,{onConfirmed:T},{default:o(()=>[a(A,{type:"button",class:x({"opacity-25":l.value}),disabled:l.value},{default:o(()=>[r(" Activer ")]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{ze as default};