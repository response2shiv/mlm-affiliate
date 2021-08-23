@extends('layouts.affiliates')
  @push('styles')
    <link href="{{ asset('css/binary_viewer.css') }}" rel="stylesheet">
  @endpush
@section('base_body')

@php
    $levelOffset = $response->rootNode->depth;
    $startLevel = $startLevel = $response->currentNode->depth - $levelOffset;
@endphp

<div class="binary-tree-page">
    <div class="content-wrap">
        <div class="left-sidebar">
            <div class="legend-wrap">
                <div class="legend-header">
                    <div class="circle-btn">
                        <i class="fa fa-angle-right arrow"></i>
                    </div>
                    <span class="title">Legend</span>
                </div>
                <div class="legend">
                    <div class="list-title">Qualification:</div>
                    <ul class="list-wrap">
                        <li>
                            <div class="image active"></div>
                            <span>Active</span>
                        </li>
                        <li>
                            <div class="image inactive"></div>
                            <span>Inactive</span>
                        </li>
                        <li>
                            <div class="image primary"><img class="customer-logo" src="/assets/images/icons/customer_profile_icon.png"></div>
                            <span>Customer</span>
                        </li>
                        <li>
                            <div class="image secondary"></div>
                            <span>Cancelled</span>
                        </li>
                         <!-- <li>
                            <div class="image pending-approval"></div>
                            <span>Pending Approval</span>
                        </li> -->
                    </ul>
                    <div class="list-title">Pack Selection:</div>
                    <ul class="list-wrap">
                        <li class="fx-class">
                            <div class="image"><img class="sidebar-logo" src="/assets/images/icons/FX_icon.png"></div> 
                            <span>FX</span>
                        </li>
                        <li class="isbo-class">
                            <div class="image"><img class="sidebar-logo" src="/assets/images/icons/ISBO_icon.png"></div> 
                            <span>ISBO</span>
                        </li>
                        <li class="vibe-overdrive-class">
                            <div class="image"><img class="sidebar-logo" src="/assets/images/icons/Basic_icon.png"></div> 
                            <span>Basic</span>
                        </li>
                        <li class="elite-class">
                            <div class="image"><img class="sidebar-logo" src="/assets/images/icons/Visionary_icon.png"></div> 
                            <span>Visionary</span>
                        </li>
                        
                        <!-- <li class="graduate-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div> 
                            <span>Graduate</span>
                        </li>
                        <li class="vibe-overdrive-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div> 
                            <span>Vibe Overdrive</span>
                        </li>
                        <li class="standby-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div>
                            <span>Standby Class</span>
                        </li>
                        <li class="coach-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div>
                            <span>Coach Class</span>
                        </li>
                        <li class="business-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div>
                            <span>Business Class</span>
                        </li>
                        <li class="first-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div>
                            <span>First Class</span>
                        </li>
                        <li class="elite-class">
                            <div class="image selected-pack"><?php echo file_get_contents('./assets/images/logo_small.svg'); ?></div>
                            <span>Elite Class</span>
                        </li> -->
                    </ul>
                    <div class="list-title">Ranks:</div>
                    <ul class="list-wrap">
                        <li>
                            <div class="image emerald"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>ncreaser</span>
                        </li>
                        <li>
                            <div class="image ncrease-500"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>ncreaser 500</span>
                        </li>
                        <li>
                            <div class="image sapphire-ambassador"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>ncreaser 1000</span>
                        </li>
                        <li>
                            <div class="image crown-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>mpacter 5K</span>
                        </li>
                        <li>
                            <div class="image ruby"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>mpacter 10K</span>
                        </li>
                        <li>
                            <div class="image impact-20k"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>mpacter 20K</span>
                        </li>
                        <li>
                            <div class="image director"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Royal mpacter 50K</span>
                        </li>
                        <li>
                            <div class="image senior-director"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Royal mpacter 100K</span>
                        </li>
                        <li>
                            <div class="image double-crown-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Elite mpacter 200K</span>
                        </li>
                        <li>
                            <div class="image ambassador"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Elite mpacter 500K</span>
                        </li>
                        <li>
                            <div class="image ambassador2"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Elite Royal mpacter 500K</span>
                        </li>

                        <!-- <li>
                            <div class="image ambassador"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Distribuitor</span>
                        </li>
                        <li>
                            <div class="image director"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Director</span>
                        </li>
                        <li>
                            <div class="image senior-director"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Senior Director</span>
                        </li>
                        <li>
                            <div class="image executive"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Executive</span>
                        </li>
                        <li>
                            <div class="image sapphire-ambassador"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Sapphire Distribuitor</span>
                        </li>
                        <li>
                            <div class="image ruby"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Ruby</span>
                        </li>
                        <li>
                            <div class="image emerald"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Emerald</span>
                        </li>
                        <li>
                            <div class="image diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Diamond</span>
                        </li>
                        <li>
                            <div class="image blue-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Blue Diamond</span>
                        </li>
                        <li>
                            <div class="image black-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Black Diamond</span>
                        </li>
                        <li>
                            <div class="image presidential-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Presidential Diamond</span>
                        </li>
                        <li>
                            <div class="image crown-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Crown Diamond</span>
                        </li>
                        <li>
                            <div class="image double-crown-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Double Crown Diamond</span>
                        </li>
                        <li>
                            <div class="image triple-crown-diamond"><?php echo file_get_contents('./assets/images/user_btree.svg'); ?></div>
                            <span>Triple Crown Diamond</span>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!-- <div class="levels-wrap">
                @for ($i = 0; $i < 4; $i++)
                    <div class="level level-{{ $i }}">
                        <span class="level-label">Level {{ $i + $startLevel }}</span>
                    </div>
                @endfor
            </div> -->
        </div>
        <div class="content">
            <h3 class="page-title">My Organization</h3>
            <div class="navigation-buttons">
                <div>
                    <a href="{{ !empty($response->currentNode) && $response->currentNode->id !== $response->rootNode->id ? route('binaryViewer', ['id' => $response->rootNode->user_id]) : '#' }}"
                        class="btn button-up js-btn-up {{ !empty($response->currentNode) && ($response->currentNode->parent_node_id === null || $response->currentNode->id === $response->rootNode->id) ? 'disabled' : '' }}"
                    >
                        <?php echo file_get_contents('./assets/images/go_to_top_icon.svg'); ?>
                        BACK TO TOP
                    </a>
                </div>
                <div>
                    <a href="{{ !empty($response->currentNode) && $response->currentNode->parent_node_id !== null ? route('binaryViewer', ['id' => $response->currentNode->parent_node_id]) : '#' }}"
                        class="btn button-up js-btn-up {{ !empty($response->currentNode) && ($response->currentNode->parent_node_id === null || $response->currentNode->id === $response->rootNode->id) ? 'disabled' : '' }}"
                    >
                        <?php echo file_get_contents('./assets/images/arrow.svg'); ?>
                        UP ONE LEVEL
                    </a>
                </div>
                <!-- <div class="buttons-bottom">
                    <a href="{{ !empty($response->lastLeftNode) ? route('binaryViewer', ['id' => $response->lastLeftNode->id]) : '#' }}" class="btn button-left js-btn-left {{ empty($response->lastLeftNode) ? 'disabled' : '' }}">
                        <?php echo file_get_contents('./assets/images/arrow.svg'); ?>
                        Bottom Left
                    </a>
                    <a href="{{ !empty($response->lastRightNode) ? route('binaryViewer', ['id' => $response->lastRightNode->id]) : '#' }}" class="btn button-right js-btn-right {{ empty($response->lastRightNode) ? 'disabled' : '' }}">
                        <?php echo file_get_contents('./assets/images/arrow.svg'); ?>
                        Bottom Right
                    </a>
                </div> -->
            </div>
            <div class="tree-wrap">
                
                <div class="tree">
                    <div class="tree-level tree-level-0">
                        @include ('affiliates.organization.binary_viewer.partials.distributor', ['node' => $response->currentNode])
                    </div>
                    <div class="tree-level tree-level-1">
                        @foreach($response->l1Nodes as $l1Node)
                            @include ('affiliates.organization.binary_viewer.partials.distributor', ['node' => $l1Node])
                        @endforeach
                    </div>
                    <div class="tree-level tree-level-2">
                        @foreach($response->l2Nodes as $l2Node)
                            @include ('affiliates.organization.binary_viewer.partials.distributor', ['node' => $l2Node])
                        @endforeach

                    </div>
                    <!--<div class="tree-level tree-level-3">
                        <div class="four-distributors-wrap">
                            @foreach($response->l3Nodes1 as $l3Node1)
                                @include ('affiliates.organization.binary_viewer.partials.distributor', ['node' => $l3Node1])
                            @endforeach
                        </div>
                        <div class="four-distributors-wrap">
                             @foreach($response->l3Nodes2 as $l3Node2)
                                @include ('affiliates.organization.binary_viewer.partials.distributor', ['node' => $l3Node2])
                            @endforeach
                        </div>
                    </div> -->
                    <div class="info-wall">
                        <div class="wall-header">
                            <div class="rank-info">
                                <div class="row">
                                    <div class="col">
                                        <div class="title">Paid-As Rank</div>    
                                    </div>
                                    <div class="col">
                                        <div class="value float-right">{{ $response->currentNode->user->paid_rank->rankdesc }}</div>    
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="percent-info">
                                <div class="title">Binary Paid</div>
                                <div class="value">{{ $response->currentNode->user->binary_paid_percent * 100 }}%</div>
                            </div> -->
                        </div>
                        <div>
                            <div class="wall-row">
                                <div class="label-column"></div>
                                <div class="leg-column">A</div>
                                <div class="leg-column">B</div>
                                <div class="leg-column">C</div>
                                <div class="leg-column">TOTAL</div>
                            </div>
                            <div class="wall-row">
                                <div class="label-column">ISBO's</div>
                                <div class="leg-column">{{ $response->aISBO }}</div>
                                <div class="leg-column">{{ $response->bISBO }}</div>
                                <div class="leg-column">{{ $response->cISBO }}</div>
                                <div class="leg-column">{{ $response->aISBO + $response->bISBO + $response->cISBO  }}</div>
                            </div>
                            <div class="wall-row">
                                <div class="label-column">Current Volume</div>
                                <div class="leg-column">{{ $response->volumes->aCV }}</div>
                                <div class="leg-column">{{ $response->volumes->bCV }}</div>
                                <div class="leg-column">{{ $response->volumes->cCV }}</div>
                                <div class="leg-column">{{ $response->volumes->aCV + $response->volumes->bCV + $response->volumes->cCV }}</div>
                            </div>
                            <div class="wall-row">
                                <div class="label-column">4 Week Volume</div>
                                <div class="leg-column">{{ $response->volumes->aFourWV }}</div>
                                <div class="leg-column">{{ $response->volumes->bFourWV }}</div>
                                <div class="leg-column">{{ $response->volumes->cFourWV }}</div>
                                <div class="leg-column">{{ $response->volumes->aFourWV + $response->volumes->bFourWV + $response->volumes->cFourWV }}</div>
                            </div>
                            <div class="wall-row">
                                <div class="label-column">4 Week PEV</div>
                                <div class="leg-column"></div>
                                <div class="leg-column"></div>
                                <div class="leg-column"></div>
                                <div class="leg-column">{{ $response->volumes->fourWeekPEV }}</div>
                            </div>
                            <!-- <div class="wall-row">
                                <div class="label-column">Total Previous Week</div>
                                <div class="leg-column">{{ $response->previousWeekTotal->left }}</div>
                                <div class="leg-column">{{ $response->previousWeekTotal->right }}</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Search
            {{-- v-bind:distributors=""
            v-bind:end=""
            v-bind:total=""
            v-bind:ranks=""
            v-bind:packs=""
            v-bind:leg=""
            v-bind:node=""
            v-bind:level="" --}}
        ></Search>

        <div class="right-sidebar">
            <div class="search-wrap open">
                <div class="search-header">
                    <div class="circle-btn">
                        <i class="fa fa-angle-right arrow"></i>
                    </div>
                    <span class="title">Downline Search</span>
                </div>

                <div class="search-section">
                    <div class="title">Downline ISBO Search</div>
                    <div class="m-input-icon m-input-icon--right inner-addon right-addon">
                        {{-- <span class="m-input-icon__icon m-input-icon__icon--right" id="send-search"><span><i class="fa fa-search"></i></span></span> --}}
                        <span class="m-input-icon__icon m-input-icon__icon--right" id="send-search"></span>
                        <!-- <div class="glyphicon glyphicon-search"></div> -->
                        <input id="search-input" data-offset="10" type="text" class="form-control m-input m-input--pill" placeholder="Search" v-on:keypress="onSearchKeyPress">                        
                        <button type="button" class="btn btn-info w-75 mb-2" id="search-btn" style="background: #00b6eb;">Search</button>
                        <br><label>NAME / ISBO# / RANK</label>
                    </div>
                    <!-- <div class="list-header"> -->
                        <!--<div class="level-header"></div>-->
                        <!-- <div class="leg-direction-checkboxes">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="radio" class="custom-control-input" id="legDirectionLeft"  name="leg" value="1" checked v-if="leg == 1">
                                <input type="radio" class="custom-control-input" id="legDirectionLeft"  name="leg" value="1" v-else>
                                <label class="custom-control-label" for="legDirectionLeft">LEFT</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="radio" class="custom-control-input" id="legDirectionRight" name="leg" value="2" checked v-if="leg == 2">
                                <input type="radio" class="custom-control-input" id="legDirectionRight" name="leg" value="2" v-else>
                                <label class="custom-control-label" for="legDirectionRight">RIGHT</label>
                            </div>
                        </div>
                    </div> -->
                {{-- <div>{{ print_r($response->distributors)}}</div> --}}
                    <div class="list-wrap">
                        <div class="distributors">
                            @if(!empty($response->distributors) && is_array($response->distributors))
                                @foreach ($response->distributors as $distributor)
                                    @if($distributor->current_product_id == 14 || ($distributor->account_status !== 'SUSPENDED' && $distributor->current_month_qv >= 100 && $distributor->account_status !== 'TERMINATED'))
                                        @php
                                            $activityClass = 'active';
                                        @endphp
                                    @else
                                        @php
                                            $activityClass = 'inactive';
                                        @endphp
                                    @endif
                                    <div class="item">
                                        {{-- <div class="{{ $activityClass }} {{ $response->packs[$distributor->current_product_id] }} {{ $response->ranks[$distributor->current_month_rank] }} "> --}}
                                        <div class="{{ $activityClass }} ">
                                                <span class="number">{{ $distributor->level }}</span>
                                            <a href="/organization/binary-viewer/{{ $distributor->binary_id }}" class="btn m-btn distributor-btn">
                                                <div class="image ambassador">
                                                    <?php echo file_get_contents('./assets/images/user_btree.svg'); ?>
                                                </div>
                                                <span class="distributor-name">{{ $distributor->firstname }} {{ $distributor->lastname }}</span>
                                                <div class="image selected-pack">
                                                    <?php echo file_get_contents('./assets/images/logo_small.svg'); ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- <button class="load-more-btn visible" id="show-more">
                            <span class="btn-txt">+ Show more</span>
                            <div class="ball-loader">
                                <div class="ball-loader-ball ball1"></div>
                                <div class="ball-loader-ball ball2"></div>
                                <div class="ball-loader-ball ball3"></div>
                            </div>
                        </button> -->

                        <div class="distributors-end">
                            @if(!empty($response->distributorsEnd) && is_array($response->distributorsEnd))
                            @foreach ($response->distributorsEnd as $distributor)
                                @if($distributor->current_product_id == 14 || ($distributor->account_status !== 'SUSPENDED' && $distributor->current_month_qv >= 100 && $distributor->account_status !== 'TERMINATED'))
                                    @php
                                        $activityClass = 'active';
                                    @endphp
                                @else
                                    @php
                                        $activityClass = 'inactive';
                                    @endphp
                                @endif
                                <div class="item">
                                    <div class="{{ $activityClass }}">
                                        <span class="number">{{ $distributor->level }}</span>
                                        <a href="/organization/binary-viewer/{{ $distributor->binary_id }}" class="btn m-btn distributor-btn">
                                            <div class="image ambassador">
                                                <?php echo file_get_contents('./assets/images/user_btree.svg'); ?>
                                            </div>
                                            <span class="distributor-name">{{ $distributor->firstname }} {{ $distributor->lastname }}</span>
                                            <div class="image selected-pack">
                                                <?php echo file_get_contents('./assets/images/logo_small.svg'); ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var csrfToken = '{{ csrf_token() }}';
    var baseUrl = '{{url('/')}}';
</script>
@endsection

@section('scripts')
    <script src="{{asset('js/ibuumerang/organization/binary.viewer.js')}}" type="text/javascript"></script>
@endsection
