import{v as g,d as p,b as r,w as l,u as o,a as e,F as w,X as _,o as m,t as x,e as f,m as b,h as d,q as c,f as u,n as y,s as v}from"./app-99aca3ad.js";import{A as V}from"./AuthenticationCard-54407c0b.js";import{_ as k}from"./Checkbox-204cb64a.js";import{_ as i}from"./InputError-7eb8a489.js";import{_ as q}from"./InputLabel-faca919b.js";import{_ as N}from"./PrimaryButton-47a1fc9f.js";import"./_plugin-vue_export-helper-c27b6911.js";const S=e("title",null,"S inscrire",-1),U={class:"main max-h-1/4"},j={class:"min-w-screen min-h-screen bg-secondaire flex items-center justify-center px-5 py-5"},C={class:"bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden",style:{"max-width":"1000px"}},T={class:"md:flex w-full h-screen",id:"main"},$=e("div",{class:"hidden md:block w-1/2 bg-indigo-500 h-full",id:"pic"},null,-1),F={class:"w-full md:w-1/2 py-10 px-5 md:px-10"},M=e("h2",{class:"text-principal text-center text-4xl mx-auto mt-2"}," Noflay ",-1),P={key:0,class:"mb-4 font-medium text-sm text-green-600"},A=["onSubmit"],B={class:"lg:grid grid-cols-7 gap-2"},D={class:"col-span-3"},z={class:"col-span-4"},E={class:"mt-4"},R={class:"mt-4"},H={key:0,class:"mt-4"},I={class:"flex items-center"},O={class:"ml-2"},X=["href"],G=["href"],J={class:"text-center"},K={class:"w-full"},L={class:"mt-2"},Q=e("span",{class:"text-principal hover:underline"}," Se connecter",-1),W={components:{Head:_}},ae=Object.assign(W,{__name:"Register",setup(Y){const s=g({name:"",email:"",phone:"",password:"",password_confirmation:"",terms:!1}),h=()=>{s.post(route("register"),{onFinish:()=>s.reset("password","password_confirmation")})};return(a,t)=>(m(),p(w,null,[r(o(_),null,{default:l(()=>[S]),_:1}),e("div",U,[e("div",j,[e("div",C,[e("div",T,[$,e("div",F,[r(V,null,{default:l(()=>[M,a.status?(m(),p("div",P,x(a.status),1)):f("",!0),e("form",{onSubmit:b(h,["prevent"])},[e("div",null,[d(e("input",{id:"name","onUpdate:modelValue":t[0]||(t[0]=n=>o(s).name=n),type:"text",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",autofocus:"",placeholder:"Votre Nom",autocomplete:"name"},null,512),[[c,o(s).name]]),r(i,{class:"mt-2",message:o(s).errors.name},null,8,["message"])]),e("div",B,[e("div",D,[d(e("input",{id:"phone","onUpdate:modelValue":t[1]||(t[1]=n=>o(s).phone=n),type:"number",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",placeholder:"Votre Telephone",required:"",autofocus:"",autocomplete:"phone"},null,512),[[c,o(s).phone]]),r(i,{class:"mt-2",message:o(s).errors.phone},null,8,["message"])]),e("div",z,[d(e("input",{id:"email","onUpdate:modelValue":t[2]||(t[2]=n=>o(s).email=n),type:"email",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Votre Mail",autocomplete:"username"},null,512),[[c,o(s).email]]),r(i,{class:"mt-2",message:o(s).errors.email},null,8,["message"])])]),e("div",E,[d(e("input",{id:"password","onUpdate:modelValue":t[3]||(t[3]=n=>o(s).password=n),type:"password",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Votre Mots de passe",autocomplete:"new-password"},null,512),[[c,o(s).password]]),r(i,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",R,[d(e("input",{id:"password_confirmation","onUpdate:modelValue":t[4]||(t[4]=n=>o(s).password_confirmation=n),type:"password",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Entrez a Nouveau",autocomplete:"new-password"},null,512),[[c,o(s).password_confirmation]]),r(i,{class:"mt-2",message:o(s).errors.password_confirmation},null,8,["message"])]),a.$page.props.jetstream.hasTermsAndPrivacyPolicyFeature?(m(),p("div",H,[r(q,{for:"terms"},{default:l(()=>[e("div",I,[r(k,{id:"terms",checked:o(s).terms,"onUpdate:checked":t[5]||(t[5]=n=>o(s).terms=n),name:"terms",required:""},null,8,["checked"]),e("div",O,[u(" I agree to the "),e("a",{target:"_blank",href:a.route("terms.show"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},"Terms of Service",8,X),u(" and "),e("a",{target:"_blank",href:a.route("policy.show"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},"Privacy Policy",8,G)])]),r(i,{class:"mt-2",message:o(s).errors.terms},null,8,["message"])]),_:1})])):f("",!0),e("div",J,[e("div",K,[r(N,{class:y(["login-button justify-center block w-full font-bold bg-gradient-to-r from-[#eb2d53] to-[#101634] text-white py-4 mt-5 rounded-[50px] shadow-[0_20px_10px_-15px_rgba(133,189,215,0.878)] border-none transition-transform duration-200 ease-in-out transform hover:scale-105 active:scale-95 text-center bg-principal hover:bg-secondaire",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:l(()=>[u(" S inscrire ")]),_:1},8,["class","disabled"])]),e("div",L,[r(o(v),{href:a.route("login"),class:"text-sm text-gray-600 hover:text-principal rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:l(()=>[u(" Deja un Compte ? "),Q]),_:1},8,["href"])])])],40,A)]),_:1})])])])])])],64))}});export{ae as default};