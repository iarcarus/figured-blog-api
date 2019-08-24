<?php

namespace App\Domain\Components\Enumerators;

final class Permissions
{
    public const WEB_BLOG_INDEX   = 'web.blog.index';
    public const WEB_BLOG_SHOW    = 'web.blog.show';
    public const WEB_BLOG_EDIT    = 'web.blog.edit';
    public const WEB_BLOG_CREATE  = 'web.blog.create';
    public const WEB_BLOG_DESTROY = 'web.blog.destroy';

    public const API_BLOG_UPDATE = 'api.blog.update';
    public const API_BLOG_STORE  = 'api.blog.store';
}
