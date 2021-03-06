<?php

namespace luya\web\jsonld;

/**
 * JsonLd - Live Blog Posting
 *
 * A blog post intended to provide a rolling textual coverage of an ongoing event through continuous updates.
 *
 *
 * @since 1.0.1
 */
class LiveBlogPosting extends BaseThing implements LiveBlogPostingInterface
{
    /**
     * @inheritdoc
     */
    public function typeDefintion()
    {
        return 'LiveBlogPosting';
    }

    use LiveBlogPostingTrait;
}
