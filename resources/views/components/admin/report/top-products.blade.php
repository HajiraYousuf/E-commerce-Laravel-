{{-- TopSellingProductsTable.blade.php --}}

@php
$products=[
['name'=>'iPhone 14 Pro Max','category'=>'Phones','sold'=>256,'revenue'=>'$28,990','profit'=>'$8,670','image'=>'https://images.unsplash.com/photo-1678652197831-2d180705cd2c?q=80&w=200'],
['name'=>'MacBook Air M2','category'=>'Laptops','sold'=>142,'revenue'=>'$21,340','profit'=>'$6,402','image'=>'https://images.unsplash.com/photo-1517336714739-489689fd1ca8?q=80&w=200'],
['name'=>'Sony WH-1000XM5','category'=>'Accessories','sold'=>315,'revenue'=>'$7,875','profit'=>'$2,360','image'=>'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=200'],
['name'=>'Apple Watch Series 9','category'=>'Wearables','sold'=>187,'revenue'=>'$6,542','profit'=>'$1,963','image'=>'https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=200'],
['name'=>'iPad Air 5th Gen','category'=>'Tablets','sold'=>98,'revenue'=>'$4,899','profit'=>'$1,469','image'=>'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?q=80&w=200'],
];
@endphp

<div class="bg-white dark:bg-[#0F172A]/90 border border-gray-200 dark:border-white/10 rounded-2xl p-5">

<div class="flex justify-between mb-5">
<h2 class="text-gray-900 dark:text-white text-xl font-semibold">Top Selling Products</h2>
<button class="text-blue-500 dark:text-blue-400 text-sm">View all →</button>
</div>

<div class="overflow-x-auto">
<table class="w-full text-sm">

<thead>
<tr class="text-left text-gray-400 border-b border-gray-200 dark:border-white/10">
<th class="pb-3">#</th>
<th class="pb-3">Image</th>
<th class="pb-3">Product</th>
<th class="pb-3">Category</th>
<th class="pb-3">Sold</th>
<th class="pb-3">Revenue</th>
<th class="pb-3">Profit</th>
</tr>
</thead>

<tbody>
@foreach($products as $i=>$p)
<tr class="border-b border-gray-100 dark:border-white/5 hover:bg-gray-50 dark:hover:bg-white/5">

<td class="py-3 text-gray-900 dark:text-white">{{$i+1}}</td>

<td class="py-3">
<img src="{{$p['image']}}" class="w-11 h-11 rounded-xl object-cover border border-gray-200 dark:border-white/10">
</td>

<td class="py-3">
<div>
<div class="text-gray-900 dark:text-white font-medium">{{$p['name']}}</div>
<div class="text-gray-400 text-xs">Premium Product</div>
</div>
</td>

<td class="py-3">
<span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300">
{{$p['category']}}
</span>
</td>

<td class="py-3 text-gray-700 dark:text-gray-300">{{$p['sold']}}</td>
<td class="py-3 text-blue-500 dark:text-blue-400 font-medium">{{$p['revenue']}}</td>
<td class="py-3 text-green-600 dark:text-green-400 font-semibold">{{$p['profit']}}</td>

</tr>
@endforeach
</tbody>

</table>
</div>

</div>