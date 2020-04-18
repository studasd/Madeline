<?php

/**
 * APIFactory module.
 *
 * This file is part of MadelineProto.
 * MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU General Public License along with MadelineProto.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Daniil Gentili <daniil@daniil.it>
 * @copyright 2016-2019 Daniil Gentili <daniil@daniil.it>
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPLv3
 *
 * @link https://docs.madelineproto.xyz MadelineProto documentation
 */

namespace danog\MadelineProto\TON;

use danog\MadelineProto\AbstractAPIFactory;

class APIFactory extends AbstractAPIFactory
{
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var engine
     */
    public $engine;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var adnl
     */
    public $adnl;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var tonNode
     */
    public $tonNode;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var validatorSession
     */
    public $validatorSession;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var catchain
     */
    public $catchain;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var overlay
     */
    public $overlay;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var dht
     */
    public $dht;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var tcp
     */
    public $tcp;
    /**
     * @internal this is a internal property generated by build_docs.php, don't change manually
     *
     * @var liteServer
     */
    public $liteServer;

    /**
     * Just proxy async requests to API.
     *
     * @param string $name     Method name
     * @param array $arguments Arguments
     *
     * @return mixed
     */
    public function __call_async(string $name, array $arguments): \Generator
    {
        $lower_name = \strtolower($name);
        if ($this->namespace !== '' || !isset($this->methods[$lower_name])) {
            $name = $this->namespace.$name;
            $aargs = isset($arguments[1]) && \is_array($arguments[1]) ? $arguments[1] : [];
            $aargs['apifactory'] = true;
            $args = isset($arguments[0]) && \is_array($arguments[0]) ? $arguments[0] : [];

            return yield $this->API->methodCall($name, $args, $aargs);
        }
        return yield $this->methods[$lower_name](...$arguments);
    }
}
