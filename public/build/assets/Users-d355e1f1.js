import{_ as c}from"./_plugin-vue_export-helper-c27b6911.js";import{d as o,a as s,F as a,g as l,o as r,t as e}from"./app-d028698b.js";const p={props:{users:Object,immobiliers:Object,voitures:Object}},i={class:"container mx-auto p-4"},n={class:"mb-8"},_=s("h2",{class:"text-2xl font-bold mb-4"},"Liste des Utilisateurs",-1),b={class:"table-auto border-collapse w-full border border-gray-300"},h=s("thead",null,[s("tr",{class:"bg-gray-200"},[s("th",{class:"border px-4 py-2"},"ID"),s("th",{class:"border px-4 py-2"},"Nom"),s("th",{class:"border px-4 py-2"},"Email"),s("th",{class:"border px-4 py-2"},"Rôle"),s("th",{class:"border px-4 py-2"},"Téléphone"),s("th",{class:"border px-4 py-2"},"Immobiliers"),s("th",{class:"border px-4 py-2"},"Voitures")])],-1),x={class:"border px-4 py-2"},y={class:"border px-4 py-2"},u={class:"border px-4 py-2"},m={class:"border px-4 py-2"},f={class:"border px-4 py-2"},g={class:"border px-4 py-2"},D={class:"border px-4 py-2"},v={class:"mb-8"},L=s("h2",{class:"text-2xl font-bold mb-4"},"Liste des Immobiliers",-1),k={class:"table-auto border-collapse w-full border border-gray-300"},w=s("thead",null,[s("tr",{class:"bg-gray-200"},[s("th",{class:"border px-4 py-2"},"ID"),s("th",{class:"border px-4 py-2"},"Nom"),s("th",{class:"border px-4 py-2"},"Catégorie"),s("th",{class:"border px-4 py-2"},"Prix"),s("th",{class:"border px-4 py-2"},"Affaire"),s("th",{class:"border px-4 py-2"},"Date de création")])],-1),I={class:"border px-4 py-2"},N={class:"border px-4 py-2"},j={class:"border px-4 py-2"},B={class:"border px-4 py-2"},O={class:"border px-4 py-2"},S={class:"border px-4 py-2"},U=s("h2",{class:"text-2xl font-bold mb-4"},"Liste des Voitures",-1),V={class:"table-auto border-collapse w-full border border-gray-300"},A=s("thead",null,[s("tr",{class:"bg-gray-200"},[s("th",{class:"border px-4 py-2"},"ID"),s("th",{class:"border px-4 py-2"},"Nom"),s("th",{class:"border px-4 py-2"},"Catégorie"),s("th",{class:"border px-4 py-2"},"Prix"),s("th",{class:"border px-4 py-2"},"Affaire"),s("th",{class:"border px-4 py-2"},"Date de création")])],-1),C={class:"border px-4 py-2"},E={class:"border px-4 py-2"},F={class:"border px-4 py-2"},P={class:"border px-4 py-2"},R={class:"border px-4 py-2"},T={class:"border px-4 py-2"};function $(q,z,d,G,H,J){return r(),o("div",i,[s("section",n,[_,s("table",b,[h,s("tbody",null,[(r(!0),o(a,null,l(d.users,t=>(r(),o("tr",{key:t.id},[s("td",x,e(t.id),1),s("td",y,e(t.name),1),s("td",u,e(t.email),1),s("td",m,e(t.role),1),s("td",f,e(t.phone),1),s("td",g,e(t.immobiliers_count),1),s("td",D,e(t.voitures_count),1)]))),128))])])]),s("section",v,[L,s("table",k,[w,s("tbody",null,[(r(!0),o(a,null,l(d.immobiliers,t=>(r(),o("tr",{key:t.id},[s("td",I,e(t.id),1),s("td",N,e(t.nom),1),s("td",j,e(t.categorie),1),s("td",B,e(t.prix)+" €",1),s("td",O,e(t.affaire),1),s("td",S,e(new Date(t.created_at).toLocaleDateString()),1)]))),128))])])]),s("section",null,[U,s("table",V,[A,s("tbody",null,[(r(!0),o(a,null,l(d.voitures,t=>(r(),o("tr",{key:t.id},[s("td",C,e(t.id),1),s("td",E,e(t.nom),1),s("td",F,e(t.categorie),1),s("td",P,e(t.prix)+" €",1),s("td",R,e(t.affaire),1),s("td",T,e(new Date(t.created_at).toLocaleDateString()),1)]))),128))])])])])}const Q=c(p,[["render",$]]);export{Q as default};