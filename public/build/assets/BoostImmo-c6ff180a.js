import{v as c,c as m,w as p,o as _,a as e,m as g,h as l,i as d,u as r,O as b}from"./app-d028698b.js";import{_ as h}from"./AppLayout-22cd7cfe.js";import"./_plugin-vue_export-helper-c27b6911.js";const f=e("template",{header:""},[e("h2",{class:"font-semibold text-xl text-gray-800 posting-tight text-center"}," Publication ")],-1),v=e("div",{class:"w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400"},null,-1),x={class:"p-6"},w={class:"w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5"},y=e("h2",{class:"my-5 text-center bg-principal text-white rounded-full py-3"},"Ecrivez votre annonce immobilliere ",-1),I={class:"mb-4"},j=e("option",{value:"1"},"Booster l article",-1),B=e("option",{value:"0"},"ne pas bosster",-1),O=[j,B],V=e("option",{value:"120"},"2 heures",-1),S=e("option",{value:"2880"},"48 heures",-1),k=e("option",{value:"4320"},"72 heures",-1),q=e("option",{value:"10080"},"1 semaine",-1),C=[V,S,k,q],M=e("button",{type:"submit",class:"bg-principal text-white px-5 py-1 rounded-2xl"},"save",-1),U={data(){return{images:[{id:1,src:"image1.jpg",alt:"Image 1",titre:"Villa"},{id:2,src:"image2.jpg",alt:"Image 2",titre:"Appartement"},{id:3,src:"image3.jpg",alt:"Image 3",titre:"Immeuble"},{id:4,src:"image4.jpg",alt:"Image 4",titre:"Chambre"},{id:5,src:"image5.jpg",alt:"Image 5",titre:"Ferme"},{id:6,src:"image5.jpg",alt:"Image 5",titre:"Verger"}],selectedImage:null}}},D=Object.assign(U,{__name:"BoostImmo",props:{maison:Object,nameSeler:Object},setup(i){const a=i,o=c({boost:a.maison.boost,duration:a.maison.duration});function u(n){b.put("/immobilierBoost/"+n,o)}return(n,t)=>(_(),m(h,null,{default:p(()=>[f,v,e("div",x,[e("div",w,[y,e("form",{onSubmit:t[2]||(t[2]=g(s=>u(i.maison.id),["prevent"]))},[e("div",I,[l(e("select",{class:"border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none focus:border-gray-500 focus:ring-gray-500",name:"boost",id:"boost","onUpdate:modelValue":t[0]||(t[0]=s=>r(o).boost=s),required:""},O,512),[[d,r(o).boost]]),l(e("select",{name:"duration",id:"duration",required:"","onUpdate:modelValue":t[1]||(t[1]=s=>r(o).duration=s),class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"},C,512),[[d,r(o).duration]])]),M],32)])])]),_:1}))}});export{D as default};