import{g as b,y as k,r as p,c as o,b as n,t as r,j as V,z as N,l as a,F as h,x as v,o as s}from"./app-47f6bd4e.js";import{u as z}from"./function-b0398b9d.js";const T={class:"container m-auto"},S={key:0},w={class:"text-center font-bold capitalize text-5xl items-center mt-4"},C={class:"flex justify-center capitalize text-3xl p-16"},j=n("span",null,"giá :",-1),B={key:0,id:"information_tool"},D=n("h1",{class:"text-center font-bold capitalize text-3xl"}," một số thông tin của tool ",-1),E={key:1,id:"image_tool"},F=n("h1",{class:"text-center font-bold capitalize text-3xl"}," một số hình ảnh tool ",-1),L=["src"],P={key:2,id:"vid_tool"},$=n("h1",{class:"text-center font-bold capitalize text-3xl"}," một số video tool ",-1),J=["src"],O={key:1},I={__name:"detail",setup(U){const m=b(),f=k(),{getExpirType:_}=z(),e=p(null),i=p(!0),c=p(null);function x(t){return/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/.test(t)}fetch("/api/product/"+f.params.id).then(t=>t.json()).then(t=>{e.value=t.product,c.value=t.enumExpir,i.value=!1}).catch(t=>{console.log(t.message),i.value=!1});function g(t){return t.toLocaleString("vi-VN",{style:"currency",currency:"VND"})}function y(t){t.expir=_(t.product_type,c.value),m.dispatch("addToCart",t)}return(t,u)=>(s(),o("div",T,[i.value?(s(),o("div",O," Loading..... ")):(s(),o("div",S,[n("h1",w,r(e.value.product_name),1),n("div",C,[j,n("span",null,r(g(e.value.product_price))+" / ",1),V(" "+r(N(_)(e.value.product_type,c.value)),1)]),n("button",{onClick:u[0]||(u[0]=l=>y(e.value)),class:"text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-3xl px-4 py-2"},"Thêm Vào Giỏ Hàng "),e.value.product_description!==null?(s(),o("div",B,[D,n("span",null,r(e.value.product_description),1)])):a("",!0),e.value.product_img!==null?(s(),o("div",E,[F,(s(!0),o(h,null,v(JSON.parse(e.value.product_img),(l,d)=>(s(),o("img",{key:d,src:l,alt:"Image Description"},null,8,L))),128))])):a("",!0),e.value.product_vid!==null?(s(),o("div",P,[$,(s(!0),o(h,null,v(JSON.parse(e.value.product_vid),(l,d)=>(s(),o("div",{key:d},[x(l)?(s(),o("iframe",{key:0,width:"560",height:"315",src:l,frameborder:"0",allowfullscreen:""},null,8,J)):a("",!0)]))),128))])):a("",!0)]))]))}};export{I as default};