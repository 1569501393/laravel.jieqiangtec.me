@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页<?php var_dump($_REQUEST);?></a>&raquo; 添加/编辑文章分类
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>分类管理</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>

        @if(count($errors) > 0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors[0]}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">

    </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        @if(isset($field->cate_id))
            <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
                <input type="hidden" name="_method" value="put">
                @else
                    <form action="{{url('admin/category')}}" method="post">
                        @endif

                        {{csrf_field()}}
                        <table class="add_tab">
                            <tbody>
                            <tr>
                                <th width="120"><i class="require">*</i>分级分类：</th>
                                <td>
                                    <select name="cate_pid">
                                        <option value="0">==顶级分类==</option>
                                        @foreach($data as $k=>$cate)
                                            <option value="{{$cate->cate_id}}"
                                                    @if(isset($field->cate_id) && $field->cate_pid == $cate->cate_id ) selected @endif >{{$cate->cate_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th><i class="require">*</i>分类名称：</th>
                                <td>
                                    <input type="text" name="cate_name"
                                           @if(isset($field->cate_name)) value="{{$field->cate_name}}" @endif >
                                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                                </td>
                            </tr>

                            <tr>
                                <th>分类标题：</th>
                                <td>
                                    <input type="text" class="lg" name="cate_title"
                                           @if(isset($field->cate_title)) value="{{$field->cate_title}}" @endif>
                                    {{--<p>标题可以写30个字</p>--}}
                                </td>
                            </tr>

                            <tr>
                                <th>关键词：</th>
                                <td>
                        <textarea
                                name="cate_keywords">@if(isset($field->cate_name)) {{$field->cate_keywords}} @endif</textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>描述：</th>
                                <td>
                        <textarea
                                name="cate_description">@if(isset($field->cate_name)) {{$field->cate_description}} @endif</textarea>
                                </td>
                            </tr>

                            <tr>
                                <th><i class="require">*</i>排序：</th>
                                <td>
                                    <input type="text" class="sm" name="cate_order"
                                           @if(isset($field->cate_order)) value="{{$field->cate_order}}" @endif>
                                </td>
                            </tr>

                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" value="提交">
                                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </form>
    </div>
@endsection