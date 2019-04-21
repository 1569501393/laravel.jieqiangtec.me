@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页<?php var_dump($_REQUEST);?></a>&raquo; 添加/编辑文章
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>文章管理</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
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
            <form action="{{url('admin/article/'.$field->cate_id)}}" method="post">
                <input type="hidden" name="_method" value="put">
                @else
            <form action="{{url('admin/article')}}" method="post">
                @endif
                        {{csrf_field()}}
                        <table class="add_tab">
                            <tbody>
                            <tr>
                                <th width="120">分类：</th>
                                <td>
                                    <select name="cate_id">
                                        @foreach($data as $k=>$cate)
                                            <option value="{{$cate->cate_id}}"
                                                    @if(isset($field->cate_id) && $field->cate_pid == $cate->cate_id ) selected @endif >{{$cate->_cate_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>文章标题：</th>
                                <td>
                                    <input type="text" class="lg" name="art_title"
                                           @if(isset($field->art_title)) value="{{$field->art_title}}" @endif>
                                </td>
                            </tr>

                            <tr>
                                <th>编辑：</th>
                                <td>
                                    <input type="text" class="sm" name="art_editor"
                                           @if(isset($field->art_editor)) value="{{$field->art_editor}}" @endif>
                                </td>
                            </tr>

                            <tr>
                                <th>缩略图：</th>
                                <td>
                                    <input type="text" size="50" name="art_thumb"
                                           @if(isset($field->art_thumb)) value="{{$field->art_thumb}}" @endif>

                                    <input id="file_upload" name="file_upload" type="file" multiple="true">

                                    <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}"
                                            type="text/javascript"></script>
                                    <link rel="stylesheet" type="text/css"
                                          href="{{asset('resources/org/uploadify/uploadify.css')}}">

                                    <style>
                                        .uploadify {
                                            display: inline-block;
                                        }

                                        .uploadify-button {
                                            border: none;
                                            border-radius: 5px;
                                            margin-top: 8px;
                                        }

                                        table.add_tab tr td span.uploadify-button-text {
                                            color: #FFF;
                                            margin: 0;
                                        }
                                    </style>


                                    <script type="text/javascript">
                                        <?php $timestamp = time();?>
                                        $(function () {
                                            $('#file_upload').uploadify({
                                                'buttonText': '图片上传',
                                                'formData': {
                                                    'timestamp': '<?php echo $timestamp;?>',
                                                    '_token': "{{csrf_token()}}"
                                                },
                                                'swf': '{{asset("resources/org/uploadify/uploadify.swf")}}',
                                                {{--'uploader' : '{{asset("resources/org/uploadify/uploadify.php")}}',--}}
                                                'uploader': '{{url("admin/upload")}}',
                                                'onUploadSuccess': function (file, data, response) {
                                                    $('input[name=art_thumb]').val(data);
                                                    $('#art_thumb_img').attr('src', '/' + data);

                                                    // alert(data);
                                                }
                                            });
                                        });
                                    </script>

                                </td>
                            </tr>

                            <tr>
                                <th></th>
                                <td>
                                    <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px">
                                </td>
                            </tr>

                            <tr>
                                <th>关键词：</th>
                                <td>
                                    <input type="text" class="lg" name="art_tag"
                                           @if(isset($field->art_tag)) value="{{$field->art_tag}}" @endif>
                                </td>
                            </tr>

                            <tr>
                                <th>描述：</th>
                                <td>
                        <textarea
                                name="art_description">@if(isset($field->art_description)) {{$field->art_description}} @endif</textarea>
                                </td>
                            </tr>

                            <tr>
                                <th>文章内容：</th>
                                <td>
                                    <script type="text/javascript" charset="utf-8"
                                            src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                                    <script type="text/javascript" charset="utf-8"
                                            src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"></script>
                                    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                                    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                                    <script type="text/javascript" charset="utf-8"
                                            src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>

                                    <script type="text/javascript">

                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue = UE.getEditor('editor');
                                    </script>

                                    <style>
                                        .edui-default {
                                            line-height: 28px;
                                        }

                                        div.edui-combox-body, div.edui-button-body, div.edui-splitbutton-body {
                                            overflow: hidden;
                                            height: 20px;
                                        }

                                        div.edui-box {
                                            overflow: hidden;
                                            height: 22px;
                                        }
                                    </style>

                                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;">@if(isset($field->art_content)) {{$field->art_content}} @endif</script>
                                </td>
                            </tr>

                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" value="提交" >
                                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
@endsection