import{v as S,r as C,x as h,c as I,w as b,o as n,a as e,d as a,g as z,h as l,C as U,u as o,t as u,F as q,m as E,q as c,e as p,i as x,p as B,k as F}from"./app-8596da2d.js";import{_ as M}from"./AppLayout-a1b50219.js";/* empty css                                                                   */import{_ as A}from"./_plugin-vue_export-helper-c27b6911.js";const i=g=>(B("data-v-3e932fe2"),g=g(),F(),g),L=i(()=>e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight text-center"}," Publication ",-1)),N={class:"w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400"},P=i(()=>e("h2",{class:"text-2xl font-bold mb-4 text-center"},"Sélectionnez une image",-1)),T={class:"grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4"},D={class:"flex flex-col items-center"},R=["value"],j={class:"text-center mt-2"},O=["src","alt"],$={key:0,class:"p-6"},G={class:"w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5"},H={class:"button my-5 text-center bg-principal text-white rounded-full py-3"},J=["onSubmit"],K={key:0},Q={class:"mb-4"},W={class:"mb-4"},X={class:"mb-4"},Y=["disabled"],Z={key:1},ee={key:0,class:"mb-4"},te=i(()=>e("label",{class:"block text-gray-700 font-bold mb-2",for:"npiece"},"Nombre de pièce",-1)),oe={key:1,class:"mb-4"},re=i(()=>e("option",{value:"vente"},"Vente",-1)),se=i(()=>e("option",{value:"location"},"Location",-1)),ie=[re,se],ne=["disabled"],ae={key:2},le={class:"images mb-4"},de=["value"],pe=["value"],ue=["value"],ce={class:"mb-4"},ge=i(()=>e("option",{value:"",disabled:"",selected:"",hidden:""},"Région",-1)),fe=i(()=>e("option",{value:"dakar"},"dakar",-1)),me=i(()=>e("option",{value:"diourbel"},"diourbel",-1)),_e=i(()=>e("option",{value:"fatick"},"fatick",-1)),he=i(()=>e("option",{value:"kaffrine"},"kaffrine",-1)),be=i(()=>e("option",{value:"kaolack"},"kaolack",-1)),xe=i(()=>e("option",{value:"kédougou"},"kédougou",-1)),ye=i(()=>e("option",{value:"kolda"},"kolda",-1)),ve=i(()=>e("option",{value:"louga"},"louga",-1)),we=i(()=>e("option",{value:"matam"},"matam",-1)),ke=i(()=>e("option",{value:"saint-louis"},"saint-louis",-1)),Ve=i(()=>e("option",{value:"sédhiou"},"sédhiou",-1)),Se=i(()=>e("option",{value:"tambacounda"},"tambacounda",-1)),Ce=i(()=>e("option",{value:"thiès"},"thiès",-1)),Ie=i(()=>e("option",{value:"ziguinchor"},"ziguinchor",-1)),ze=[ge,fe,me,_e,he,be,xe,ye,ve,we,ke,Ve,Se,Ce,Ie],Ue=i(()=>e("button",{type:"submit",class:"bg-principal text-white px-5 py-1 rounded-2xl"},"Soumettre",-1)),qe={__name:"immobilier",setup(g){const t=S({nom:null,description:null,prix:null,region:null,image1:null,image2:null,image3:null,type:null,npiece:null,surface:null,affaire:null}),d=C(1);function m(){d.value<3&&d.value++}function _(){d.value>1&&d.value--}function y(){let f="/immobilier/save";t.type==="Verger"?f="/immobilier2/save":t.type==="Ferme"&&(f="/immobilier3/save"),t.post(f)}const v=[{id:1,src:"/storage/slide/villa.png",alt:"Image 1",titre:"Villa"},{id:2,src:"/storage/slide/appartement.png",alt:"Image 2",titre:"Appartement"},{id:3,src:"/storage/slide/terrain.png",alt:"Image 3",titre:"Terrain"},{id:4,src:"/storage/slide/chambre.png",alt:"Image 4",titre:"Chambre"},{id:5,src:"/storage/slide/immeuble.png",alt:"Image 5",titre:"Immeuble"},{id:6,src:"/storage/slide/verger.png",alt:"Image 6",titre:"Verger"},{id:7,src:"/storage/slide/ferme.png",alt:"Image 7",titre:"Ferme"}],w=h(()=>t.nom&&t.prix&&t.description),k=h(()=>["Villa","Appartement","Immeuble","Chambre"].includes(t.type)?t.npiece&&t.affaire:t.surface&&t.affaire);return(f,s)=>(n(),I(M,null,{header:b(()=>[L]),default:b(()=>[e("div",N,[P,e("div",T,[(n(),a(q,null,z(v,r=>e("div",{class:"flex flex-col items-center justify-center",key:r.id},[e("label",D,[l(e("input",{type:"radio",class:"text-principal focus:border-white focus:ring-white",value:r.titre,"onUpdate:modelValue":s[0]||(s[0]=V=>o(t).type=V)},null,8,R),[[U,o(t).type]]),e("h3",j,u(r.titre),1),e("img",{src:r.src,alt:r.alt,class:"w-2/5 rounded-lg shadow-lg mt-2"},null,8,O)])])),64))])]),o(t).type?(n(),a("div",$,[e("div",G,[e("h2",H,"Ecrivez votre annonce "+u(o(t).type.toLowerCase()),1),e("form",{onSubmit:E(y,["prevent"])},[d.value===1?(n(),a("div",K,[e("div",Q,[l(e("input",{class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",id:"nom",name:"nom",type:"text",placeholder:"Entrez le titre de votre annonce","onUpdate:modelValue":s[1]||(s[1]=r=>o(t).nom=r),required:""},null,512),[[c,o(t).nom]])]),e("div",W,[l(e("input",{class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",id:"prix",type:"text",placeholder:"Entrez le prix",name:"prix","onUpdate:modelValue":s[2]||(s[2]=r=>o(t).prix=r),required:""},null,512),[[c,o(t).prix]])]),e("div",X,[l(e("textarea",{class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",id:"description",rows:"5",name:"description","onUpdate:modelValue":s[3]||(s[3]=r=>o(t).description=r),placeholder:"Entrez la description",required:""},null,512),[[c,o(t).description]])]),e("button",{type:"button",onClick:m,class:"bg-principal text-white px-5 py-1 rounded-2xl",disabled:!o(w)},"Suivant",8,Y)])):p("",!0),d.value===2?(n(),a("div",Z,[o(t).type==="Villa"||o(t).type==="Appartement"||o(t).type==="Immeuble"||o(t).type==="Chambre"?(n(),a("div",ee,[te,l(e("input",{class:"shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"npiece",name:"npiece",type:"text",placeholder:"Entrez le nombre de pièce","onUpdate:modelValue":s[4]||(s[4]=r=>o(t).npiece=r),required:""},null,512),[[c,o(t).npiece]])])):(n(),a("div",oe,[l(e("input",{class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",id:"surface",name:"surface",type:"text",placeholder:"Entrez la surface","onUpdate:modelValue":s[5]||(s[5]=r=>o(t).surface=r),required:""},null,512),[[c,o(t).surface]])])),l(e("select",{class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",id:"affaire",name:"affaire","onUpdate:modelValue":s[6]||(s[6]=r=>o(t).affaire=r)},ie,512),[[x,o(t).affaire]]),e("button",{type:"button",onClick:_,class:"bg-gray-500 mt-5 text-white px-5 py-1 rounded-2xl"},"Précédent"),e("button",{type:"button",onClick:m,class:"bg-principal mt-5 text-white px-5 py-1 rounded-2xl",disabled:!o(k)},"Suivant",8,ne)])):p("",!0),d.value===3?(n(),a("div",ae,[e("div",le,[e("input",{type:"file",onChange:s[7]||(s[7]=r=>o(t).image1=r.target.files[0]),class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"},null,32),o(t).progress?(n(),a("progress",{key:0,value:o(t).progress.percentage,max:"100"},u(o(t).progress.percentage)+"%",9,de)):p("",!0),e("input",{type:"file",onChange:s[8]||(s[8]=r=>o(t).image2=r.target.files[0]),class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"},null,32),o(t).progress?(n(),a("progress",{key:1,value:o(t).progress.percentage,max:"100"},u(o(t).progress.percentage)+"%",9,pe)):p("",!0),e("input",{type:"file",onChange:s[9]||(s[9]=r=>o(t).image3=r.target.files[0]),class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"},null,32),o(t).progress?(n(),a("progress",{key:2,value:o(t).progress.percentage,max:"100"},u(o(t).progress.percentage)+"%",9,ue)):p("",!0)]),e("div",ce,[l(e("select",{class:"border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none","onUpdate:modelValue":s[10]||(s[10]=r=>o(t).region=r),required:""},ze,512),[[x,o(t).region]])]),e("button",{type:"button",onClick:_,class:"bg-gray-500 text-white px-5 py-1 rounded-2xl"},"Précédent"),Ue])):p("",!0)],40,J)])])):p("",!0)]),_:1}))}},Ae=A(qe,[["__scopeId","data-v-3e932fe2"]]);export{Ae as default};