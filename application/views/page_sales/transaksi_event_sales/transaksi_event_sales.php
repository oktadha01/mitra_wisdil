<style>

</style>

<!-- <div class="container">
    <div class="row">
        <div class="col p-1">
            <div class=" search">
                <input type="text" id="searchInput" placeholder="Search...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row">
        <div class="col p-1">

            <div class="tab-slider--nav mt-3">
                <ul class="tab-slider--tabs">
                    <li class="tab-slider--trigger active" rel="tab1">Ditahan</li>
                    <li class="tab-slider--trigger" rel="tab2">Diproses</li>
                    <li class="tab-slider--trigger" rel="tab3">Dibayar</li>
                </ul>
            </div>
            <div class="tab-slider--container">
                <div id="tab1" class="tab-slider--body">
                    <div class="container">
                        <ul id="transaksiList-0" class="list-group d-block">
                        </ul>
                    </div>
                </div>
                <div id="tab2" class="tab-slider--body">
                    <div class="container">
                        <ul id="transaksiList-1" class="list-group d-block">
                        </ul>
                    </div>
                </div>
                <div id="tab3" class="tab-slider--body">
                    <div class="container">
                        <ul id="transaksiList-2" class="list-group d-block">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>