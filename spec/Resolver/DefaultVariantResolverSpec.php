<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Product\Resolver;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Product\Resolver\DefaultVariantResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Product\Model\VariantInterface;
use Sylius\Component\Product\Resolver\VariantResolverInterface;

/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
final class DefaultVariantResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DefaultVariantResolver::class);
    }

    function it_implements_variant_resolver_interface()
    {
        $this->shouldImplement(VariantResolverInterface::class);
    }

    function it_returns_first_variant(
        ProductInterface $product,
        VariantInterface $variant,
        Collection $variants
    ) {
        $product->getVariants()->willReturn($variants);
        $variants->isEmpty()->willReturn(false);
        $variants->first()->willReturn($variant);

        $this->getVariant($product)->shouldReturn($variant);
    }

    function it_returns_null_if_first_variant_is_not_definied(ProductInterface $product, Collection $variants)
    {
        $product->getVariants()->willReturn($variants);
        $variants->isEmpty()->willReturn(true);

        $this->getVariant($product)->shouldReturn(null);
    }
}
