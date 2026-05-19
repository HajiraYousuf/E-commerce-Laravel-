<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
$revenueData=[
'weekly'=>[
['label'=>'May 12','value'=>5000],
['label'=>'May 19','value'=>9000],
['label'=>'May 26','value'=>7000],
['label'=>'Jun 02','value'=>14000],
['label'=>'Jun 08','value'=>18000],
],
'daily'=>[
['label'=>'Mon','value'=>2000],
['label'=>'Tue','value'=>4000],
['label'=>'Wed','value'=>3000],
['label'=>'Thu','value'=>5000],
['label'=>'Fri','value'=>7000],
],
'monthly'=>[
['label'=>'Jan','value'=>8000],
['label'=>'Feb','value'=>12000],
['label'=>'Mar','value'=>10000],
['label'=>'Apr','value'=>15000],
['label'=>'May','value'=>20000],
],
'yearly'=>[
['label'=>'2021','value'=>10000],
['label'=>'2022','value'=>15000],
['label'=>'2023','value'=>13000],
['label'=>'2024','value'=>18000],
['label'=>'2025','value'=>20000],
]
];
@endphp


<div class="bg-white dark:bg-gray-900 rounded-3xl p-4 sm:p-6 border border-gray-100 dark:border-gray-800 shadow-sm h-full">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">
            Revenue Over time
        </h2>

        <select id="filter"
            class="px-3 py-2 border rounded-xl text-sm text-gray-600 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700">

            <option value="weekly" selected>Weekly</option>
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>

        </select>

    </div>

    <div class="h-[260px] sm:h-[320px]">
        <canvas id="chart"></canvas>
    </div>

</div>


<script>

const rawData=@json($revenueData);

function isDark(){
    return document.documentElement.classList.contains('dark');
}

function getData(type){
let labels=[],values=[];
rawData[type].forEach(i=>{
labels.push(i.label);
values.push(i.value);
});
return{labels,values};
}

let current=getData('weekly');

const ctx=document.getElementById('chart').getContext('2d');

let chart=new Chart(ctx,{
type:'line',

data:{
labels:current.labels,
datasets:[{
data:current.values,
borderColor:'#6366f1',
borderWidth:3,
tension:0.5,
cubicInterpolationMode:'monotone',
pointRadius:3,
pointHoverRadius:6,
pointBackgroundColor:'#6366f1',
pointBorderWidth:2,
pointBorderColor:'#fff',
fill:true,
backgroundColor:(context)=>{
const c=context.chart.ctx;
const g=c.createLinearGradient(0,0,0,300);
g.addColorStop(0,'rgba(99,102,241,0.25)');
g.addColorStop(1,'rgba(99,102,241,0)');
return g;
}
}]
},

options:{
responsive:true,
maintainAspectRatio:false,

plugins:{
legend:{display:false},

tooltip:{
backgroundColor:isDark() ? '#111827' : '#ffffff',
titleColor:isDark() ? '#fff' : '#111827',
bodyColor:isDark() ? '#d1d5db' : '#374151',
padding:10,
cornerRadius:10,
displayColors:false,
callbacks:{
label:(ctx)=>'$'+ctx.raw.toLocaleString()
}
}
},

interaction:{mode:'index',intersect:false},

scales:{

y:{
min:0,
max:20000,

ticks:{
stepSize:5000,
color:isDark() ? '#9ca3af' : '#6b7280',
callback:v=>v/1000+'k USD'
},

grid:{
color:isDark() ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.05)'
}
},

x:{
ticks:{
color:isDark() ? '#9ca3af' : '#6b7280'
},
grid:{display:false}
}

}

}
});

document.getElementById('filter').addEventListener('change',function(){
let d=getData(this.value);
chart.data.labels=d.labels;
chart.data.datasets[0].data=d.values;
chart.update();
});

</script>